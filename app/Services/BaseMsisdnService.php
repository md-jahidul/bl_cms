<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\BannerRepository;
use App\Repositories\BaseMsisdnGroupRepository;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BaseMsisdnGroup;
use App\Models\BaseMsisdn;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BaseMsisdnService
{
    use CrudTrait;


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

    protected function uploadPrepare($request, $baseGroup)
    {
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
            $insertData = array();
            foreach ($reader->getSheetIterator() as $sheet) {
                $row_number = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $msisdn = $cells[0]->getValue();
                    $insertData[] = ['group_id' => $baseGroup->id, 'msisdn' => $msisdn];
                }
            }

        } else {
            if ($request->has('segment_type') && $request->input('segment_type') == 'yes' && !empty($request->input('custom_msisdn'))) {
                $individuals = explode(',', $request->input('custom_msisdn'));
                foreach ($individuals as $individual) {
                    $insertData[] = [
                        'group_id' => $baseGroup->id,
                        'msisdn' => $individual,
                        'created_at' => Carbon::now()
                    ];
                }
            } else {
                return Response('Individual number field is empty');
            }
        }
        foreach (array_chunk($insertData, 1000) as $key => $smallerArray) {
            foreach ($smallerArray as $index => $value) {
                $temp[$index] = str_replace(' ', '', $value);
            }
            BaseMsisdn::insert($temp);
        }
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
                $this->uploadPrepare($request, $baseGroup);
                return Response('Upload successfully completed !');
            });
        } catch (\Exception $e) {
            Log::error('Base Msisdn Save: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * @param $request
     * @param $id
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function updateBaseMsisdnGroup($request, $id)
    {
        try {
            return DB::transaction(function () use ($request, $id) {
                $baseGroup = $this->findOne($id);
                $baseGroup->update($request->all());
                if (isset($request->msisdn_file) || !empty($request->custom_msisdn)) {
                    BaseMsisdn::where('group_id', $baseGroup->id)->delete();
                    $this->uploadPrepare($request, $baseGroup);
                }
                return Response('Upload successfully completed !');
            });
        } catch (\Exception $e) {
            Log::error('Base Msisdn Save: ' . $e->getMessage());
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

}
