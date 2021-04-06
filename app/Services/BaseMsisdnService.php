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
use Illuminate\Http\Response;
use App\Models\BaseMsisdnGroup;
use App\Models\BaseMsisdn;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    public function storeBaseMsisdnGroup($request)
    {
        try {
        return DB::transaction(function () use ($request) {
            $baseGroup = $this->baseMsisdnGroupRepository->save($request->all());
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
                        $insertData[] = ['group_id' => $baseGroup->id, 'msisdn' => $individual];
                    }
                } else {
                    return Response('Individual number field is empty');
                }
            }
            BaseMsisdn::insert($insertData);
            return Response('Upload successfully completed !');

        });
        } catch (\Exception $e) {

            Log::error('Base Msisdn Save: ' . $e->getMessage());
            return false;
        }
    }


}
