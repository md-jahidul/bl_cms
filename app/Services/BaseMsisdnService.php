<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Exceptions\BLServiceException;
use App\Exceptions\MsisdnUploadFailedException;
use App\Helpers\BaseMsisdnHelper;
use App\Repositories\BannerRepository;
use App\Repositories\BaseMsisdnGroupRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use App\Models\BaseMsisdn;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Throw_;

class BaseMsisdnService
{
    use CrudTrait;

    protected const FLASH_HOUR_REDIS_KEY = "base_msisdn_";

    /**
     * @var $baseMsisdnGroupRepository
     */
    protected $baseMsisdnGroupRepository;

    /**
     * BaseMsisdnGroupRepository constructor.
     * @param BaseMsisdnGroupRepository $baseMsisdnGroupRepository
     */
    public function __construct(BaseMsisdnGroupRepository $baseMsisdnGroupRepository)
    {
        $this->baseMsisdnGroupRepository = $baseMsisdnGroupRepository;
        $this->setActionRepository($baseMsisdnGroupRepository);
    }

    /**
     * @param $id
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function excelGenerator($id)
    {
        $baseMsisdnGroup = $this->findOne($id);
        $baseMsisdns = BaseMsisdn::where('group_id', $id)->get();
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToBrowser("$baseMsisdnGroup->title-" . date('Y-m-d') . '.xlsx');
        foreach ($baseMsisdns as $msisdn) {
            $cells = [
                WriterEntityFactory::createCell($msisdn->msisdn),
            ];
            $singleRow = WriterEntityFactory::createRow($cells);
            $writer->addRow($singleRow);
        }
        $writer->close();
    }

    public function getBaseMsisdn($request, $id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $builder = new BaseMsisdn();
        $builder = $builder->where('group_id', $id);

        if (isset($request->search['value'])) {
            $keyWord = $request->search['value'];
            $builder = $builder->where('msisdn', 'LIKE', "%$keyWord%");
        }
        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'msisdn' => $item->msisdn,
                'created_at' => $item->created_at,
            ];
        });
        return $response;
    }

    /**
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Common\Exception\IOException
     */
    protected function uploadPrepare($request, $baseGroup, $action = 'insert')
    {
        $insertData = array();
        if ($request->hasFile('msisdn_file')) {
            $file = $request->file('msisdn_file');
            $path = $file->storeAs(
                'base_msisdn/' . strtotime(now()),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $excel_path = Storage::disk('public')->path($path);
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $file_path = $excel_path;
            $reader->open($file_path);
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $key => $row) {
                    $cells = $row->getCells();
                    $msisdn = trim($cells[0]->getValue());

                    if (strlen($msisdn) < 10) {
                        return [
                            'status' => false,
                            'message' => 'Upload Failed! Wrong msisdn at row: ' . $key
                        ];
                    }
                    $insertData[] = "0" . substr($msisdn, -10) ;
                }
            }
        } else {
            if ($request->has('segment_type') && $request->input('segment_type') == 'yes' && !empty($request->input('custom_msisdn'))) {
                $individuals = explode(',', $request->input('custom_msisdn'));
                foreach ($individuals as $individual) {
                    $insertData[] = trim($individual);
                }
            } else {
                return Response('Individual number field is empty');
            }
        }

        if ($action == "update") {
            BaseMsisdn::where('group_id', $baseGroup->id)->delete();
        }

        foreach (array_chunk($insertData, 1000) as $key => $smallerArray) {
            foreach ($smallerArray as $index => $value) {
                $temp[$index] = [
                    'group_id' => $baseGroup->id,
                    'msisdn' => $value
                ];
            }
            BaseMsisdn::insert($temp);
        }

        // Redis delete and add
        $redisKey = self::FLASH_HOUR_REDIS_KEY . $baseGroup->id;
        $keyExpireTtl = Redis::ttl($redisKey);
        if ($keyExpireTtl > 1) {
            Redis::del($redisKey);
            BaseMsisdnHelper::baseMsisdnAddInRedis($baseGroup->id, $keyExpireTtl);
        }

        return [
            'status' => true,
            'message' => 'Upload successfully completed !'
        ];
    }

    /**
     * @param $request
     * @return string
     */
    public function storeBaseMsisdnGroup($request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $baseGroup = $this->baseMsisdnGroupRepository->save($request->all());
                $response = $this->uploadPrepare($request, $baseGroup);
                if (!$response['status']) {
                    DB::rollBack();
                }
                return $response;
            });
        } catch (\Exception $e) {
            Log::error('Base Msisdn Save: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * @param $request
     * @param $id
     * @return false|Application|ResponseFactory|Response|mixed
     */
    public function updateBaseMsisdnGroup($request, $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                if (isset($request->msisdn_file) || !empty($request->custom_msisdn)) {
                    $baseGroup = $this->findOne($id);
                    $baseGroup->update($request->all());
                    return $this->uploadPrepare($request, $baseGroup, 'update');
                }
                return [
                    'status' => false,
                    'message' => 'Please input a excel file'
                ];
            });
        } catch (\Exception $e) {
            Log::error('Base Msisdn Save: ' . $e->getMessage());
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

}
