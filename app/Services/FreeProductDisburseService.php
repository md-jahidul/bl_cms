<?php

namespace App\Services;


use App\Enums\HttpStatusCode;
use App\Exceptions\BLServiceException;
use App\Exceptions\CurlRequestException;
use App\Jobs\FreeProductDisburseJob;
use App\Models\FreeProductDisburse;
use App\Models\MasterLog;
use App\Repositories\FreeProductDisburseRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class FreeProductDisburseService
{
    use CrudTrait;
    private $freeProductDisburseRepository;
    protected const PURCHASE_ENDPOINT = "/provisioning/provisioning/purchase";
    protected const IDP_TOKEN_REDIS_KEY = "IDP_TOKEN";
    public function __construct(FreeProductDisburseRepository $freeProductDisburseRepository)
    {
        $this->freeProductDisburseRepository = $freeProductDisburseRepository;
        $this->setActionRepository($this->freeProductDisburseRepository);
    }

    protected function getHost()
    {
        return env('BL_API_HOST');
    }


    public function saveMsisdns($excel_path)
    {
        try {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);
            $id = uniqid();
            $freeProductData = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $row_no = 0;
                foreach ($sheet->getRowIterator() as $row) {
                    ++$row_no;
                    if ($row_no == 1) continue;

                    $cells = $row->getCells();
                    $data = [
                        'file_id' => $id,
                        'msisdn' => '880' . substr($cells[0]->getValue(), -10),
                        'product_code' => $cells[1]->getValue(),
                        'created_at' => Carbon::now()
                    ];
                    $freeProductData[] = $data;
                }

                FreeProductDisburse::insert($freeProductData);
                FreeProductDisburseJob::dispatch($id)->onQueue('free-product-disburse');
//                    ->delay(Carbon::now()->addSeconds(300));
            }
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function productPurchase($param)
    {
        $mobile = $param['msisdn'];
        $product_code = $param['id'];

        $result = $this->placePurchaseRequest($param);

        if ($result['status_code'] == 200) {

            $saveLogData['msisdn'] = $mobile;
            $saveLogData['log_type'] = 'Free Product Disburse';
            $saveLogData['status'] = 200;
            $saveLogData['message'] = "Purchase request in Progress";
            $saveLogData['response'] = $result['response'];
            $saveLogData['others'] = $product_code;

            MasterLog::create($saveLogData);
            return true;
        }

        return false;
    }

    public function placePurchaseRequest($param)
    {
        $param = [ "MobileAppAndroid"] + $param;

        return $this->post(self::PURCHASE_ENDPOINT, $param);
    }

    protected function post($url, $body = [], $headers = null, $skip_service_exception = false)
    {
        return $this->makeMethod('post', $url, $body, $headers, $skip_service_exception);
    }

    protected function makeMethod(
        $method,
        $url,
        $body = [],
        $headers = null,
        $skip_service_exception = false
    ) {
            //$start_time = microtime(true);
    
            $ch = curl_init();
            $headers = $headers ?: $this->makeHeader();
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            static::makeRequest($ch, $url, $body, $headers);
            $result = curl_exec($ch);
    
            //$end_time = microtime(true);
    
            $curl_info = curl_getinfo($ch);
    
    
            if ($result != '' && !$result) {
                throw new CurlRequestException(curl_getinfo($ch));
            }
            $httpCode = $curl_info['http_code'];
    
            if ($httpCode >= 500 && !$skip_service_exception) {
                throw new BLServiceException($result);
            }
    
            /*        try {
                        $this->logToApiPerformance([
                            'url' => $curl_info['url'],
                            'start_time' => $start_time,
                            'end_time' => $end_time,
                            'response_time' => $end_time - $start_time,
                            'response' => $result
                        ]);
                    } catch (Exception $e) {
                    }*/
    
        return ['response' => $result, 'status_code' => $httpCode];
    }

    /**
     * Make CURL object for HTTP request verbs.
     *
     * @param  curl_init() $ch
     * @param  string  $url
     * @param  array  $body
     * @param  array  $headers
     * @return string
     */
    protected function makeRequest($ch, $url, $body, $headers)
    {
        $url = $this->getHost() . $url;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }

    protected function makeHeader()
    {
        $client_token = Redis::get(self::IDP_TOKEN_REDIS_KEY);
        $customer_token = app('request')->bearerToken();

        $header = [
            'Accept: application/vnd.banglalink.apihub-v1.0+json',
            'Content-Type: application/vnd.banglalink.apihub-v1.0+json',
            'client_authorization:' . $client_token,
            'customer_authorization:' . $customer_token
        ];

        return $header;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getFreeProductDisburseData(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new FreeProductDisburse();

        $builder = $builder->latest();

        if ($request->from && $request->to) {
            $datefrom = $request->from . ' 00:00:00';
            $dateto = $request->to . ' 23:59:59';
            $builder = $builder->whereBetween('created_at', [$datefrom, $dateto]);
        }

        $all_items_count = $builder->count();

        if ($length == -1 ) $length = $all_items_count;

        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'file_id' => $item->file_id,
                'msisdn' => $item->msisdn,
                'product_code' => $item->product_code,
                'is_disburse' => ($item->is_disburse)? 'Disbursed' : 'Not Disbursed',
                'created_at' => date('Y-m-d H:i:s', strtotime($item->created_at)),
            ];
        });
        return $response;
    }
}
