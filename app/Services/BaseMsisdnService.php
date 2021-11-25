<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Helpers\BaseMsisdnHelper;
use App\Jobs\BaseMsisdnFileUpload;
use App\Models\BaseMsisdnFile;
use App\Repositories\BaseMsisdnFileRepository;
use App\Repositories\BaseMsisdnGroupRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use App\Models\BaseMsisdn;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class BaseMsisdnService
{
    use CrudTrait;
    use FileTrait;

    protected const FLASH_HOUR_REDIS_KEY = "base_msisdn_";

    /**
     * @var $baseMsisdnGroupRepository
     */
    protected $baseMsisdnGroupRepository;
    /**
     * @var BaseMsisdnFileRepository
     */
    private $baseMsisdnFileRepository;

    /**
     * BaseMsisdnGroupRepository constructor.
     * @param BaseMsisdnGroupRepository $baseMsisdnGroupRepository
     */
    public function __construct(
        BaseMsisdnGroupRepository $baseMsisdnGroupRepository,
        BaseMsisdnFileRepository $baseMsisdnFileRepository
    ) {
        $this->baseMsisdnGroupRepository = $baseMsisdnGroupRepository;
        $this->baseMsisdnFileRepository = $baseMsisdnFileRepository;
        $this->setActionRepository($baseMsisdnGroupRepository);
    }

    /**
     * @param $id
     * @throws IOException
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

    protected function filePrepare($insertData, $baseFileData)
    {
        $baseFileInfo = $this->baseMsisdnFileRepository->save($baseFileData);
        foreach (array_chunk($insertData, 800) as $smallerArray) {
            foreach ($smallerArray as $index => $value) {
                $temp[$index] = [
                    'group_id' => $baseFileData['base_msisdn_group_id'],
                    'base_msisdn_file_id' => $baseFileInfo->id,
                    'msisdn' => $value
                ];
            }
            BaseMsisdn::insert($temp);
        }
    }

    /**
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     * @throws UnsupportedTypeException
     * @throws IOException
     */
    protected function uploadPrepare($request, $baseGroup, $action = 'insert')
    {
        if (isset($request->base_msisdn_files)) {
            $currentFileId = [];
            $insertData = array();
            foreach ($request->base_msisdn_files as $file) {
                if ($action == "update" && isset($file['file_id'])) {
                    $findFile = $this->baseMsisdnFileRepository->findOne($file['file_id']);
                    $fileData['title'] = $file['file_title'];
                    $findFile->update($fileData);
                }
                $currentFileId[] = $file['file_id'] ?? '';
                if (!empty($file['file_name'])) {
                    $fileOrgName = $file['file_name']->getClientOriginalName();
                    $fileName = pathinfo($fileOrgName, PATHINFO_FILENAME);
                    $fileExt = $file['file_name']->getClientOriginalExtension();
                    $fileName = $fileName . "-" . uniqid(2) . "." . $fileExt;
                    $path = $this->upload($file['file_name'], 'base-msisdn-files', $fileName);

                    $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
                    $file_path = $this->getPath($path);
                    $reader->open($file_path);

                    $baseFileData = [
                        'file_name' => $path,
                        'title' => $file['file_title'],
                        'base_msisdn_group_id' => $baseGroup->id,
                        'status' => 0,
                    ];

                    foreach ($reader->getSheetIterator() as $sheet) {
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            $cells = $row->getCells();
                            $msisdn = trim($cells[0]->getValue());
                            if (strlen($msisdn) < 10) {
                                return [
                                    'status' => false,
                                    'message' => "<b>FIle Name:</b>  $fileOrgName <br> Upload Failed! Wrong msisdn at row: " . $key
                                ];
                            }
                            $insertData[] = "0" . substr($msisdn, -10);
                        }
                    }
                }
            }

            $million = env('BASE_MSISDN_LIMIT_MILLION', 3);
            $msisdnLimit = 100000 * 10 * $million;

            if (count($insertData) > $msisdnLimit) {
                $inputMsisdn = count($insertData) / 1000000;
                return [
                    'status' => false,
                    'message' => " Limit exceeded!! Maximum base limit is $million Million. You provided input $inputMsisdn Million"
                ];
            }

            $this->filePrepare($insertData, $baseFileData);

            $fileIds = isset($request['old_ids']) ? array_diff($request['old_ids'], $currentFileId) : [];
            if (!empty($fileIds)) {
                collect($fileIds)->each(function (int $id) {
                    $fileInfo = $this->baseMsisdnFileRepository->findOne($id);
                    $this->deleteFile($fileInfo->file_name);
                });

                $this->baseMsisdnFileRepository->deleteFile($fileIds);
                BaseMsisdn::whereIn('base_msisdn_file_id', $fileIds)->delete();
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

        return [
            'status' => false,
            'message' => 'Please input a excel file'
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
//                dd($response);
                if (!$response['status']) {
                    DB::rollBack();
                }
                return $response;
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
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
                $baseGroup = $this->findOne($id);
                $baseGroup->update($request->all());
                return $this->uploadPrepare($request, $baseGroup, 'update');
            });
        } catch (\Exception $e) {
            Log::error('Base Msisdn Save: ' . $e->getMessage());
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

}
