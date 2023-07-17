<?php

namespace App\Services;


use App\Enums\HttpStatusCode;
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

        return $this->postV2(self::PURCHASE_ENDPOINT, $param);
    }

    protected function postV2($url, $body = [], $headers = null, $skip_service_exception = false)
    {
        return $this->makeMethodV2('post', $url, $body, $headers, $skip_service_exception);
    }

    protected function makeMethodV2(
        $method,
        $url,
        $body = [],
        $headers = null,
        $skip_service_exception = false
    ) {

        $headers = $headers ?: $this->makeHeaderV2();
        $client = new Client(['base_uri' => $this->getHost()]);
        $responseData = [];
        $statusCode = 500;
        try {

            $response = $client->request(
                strtoupper($method),
                $url,
                [
                    'connect_timeout' => 5,
                    'headers' => $headers,
                    'json' => $body
                ]
            );


        } catch (RequestException $e) {

            Log::channel('apihub-error')->info('Request body : ' . json_encode($body));

            if ($e->hasResponse() && ($e->getResponse()->getStatusCode() >= 400 || !$e->getResponse()->getBody())) {
                $exception = (string)$e->getResponse()->getBody();
                $exception = json_decode($exception);
                if ($url == '/otp/one-time-passwords') {
                    $message = ['status' => $exception->status, 'error' => $exception->error, 'message' => $exception->message, 'url' => $exception->path];
                    Log::channel('apihub-error')->error('ApiHub  Exception1 (OTP):' .json_encode($message));
                } else {
                    // Log::channel('apihub-error')->error('ApiHUb  Exception1:' . $e->getResponse()->getBody(), $exception ? [$exception] : []);
                    Log::channel('apihub-error')->error('ApiHUb  Exception1: ' . $e->getMessage(), $exception ? [$exception] : []);
                }

            }
            else {
                Log::channel('apihub-error')->error('ApiHUb Exception2: ' . $e->getTraceAsString());
            }

            return ['response' => $e->getMessage(),'status_code' => $e->getResponse()->getStatusCode()];

        }

        $returned_data = [];
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $returned_data = json_decode($body, true);
        }

        return ['response' => json_encode($returned_data, true), 'status_code' => $response->getStatusCode()];
    }

    protected function makeHeaderV2()
    {
        $client_token = Redis::get(self::IDP_TOKEN_REDIS_KEY);
        $customer_token = app('request')->bearerToken();

        $header = [
            'Accept' => 'application/vnd.banglalink.apihub-v1.0+json',
            'Content-Type' => 'application/vnd.banglalink.apihub-v1.0+json',
            'client_authorization' => $client_token,
            'customer_authorization' => $customer_token
        ];

        return $header;

    }
}
