<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessInternet;
use App\Models\RoamingOperator;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class RoamingOperatorRepository extends BaseRepository {

    public $modelName = RoamingOperator::class;

    public function getOperatorList($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->model;


        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->latest()->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {

            $statusBtn = "<a href='$item->id' class='btn-sm btn-success operator_change_status'>Active</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning operator_change_status'>Inactive</a>";
            }
            $response['data'][] = [
                'id' => $item->id,
                'country_en' => $item->country_en,
                'operator_en' => $item->operator_en,
                'tap_code' => $item->tap_code,
                'status' => $statusBtn
            ];
        });

        return $response;
    }

    public function getInternetById($internetId){
         return $this->model->findOrFail($internetId);
    }

    public function getAllPackage($internetId) {
        $allProducts = $this->model->select('id', 'product_code', 'product_name')->where('status', 1);
        if($internetId > 0){
            $allProducts->where('id', '!=', $internetId);
        }
        $data = $allProducts->get();

        return $data;

    }

    public function saveInternet($bannerPath, $request)
    {
        $insertdata = array(
            'product_code' => $request->product_code,
            'product_code_ev' => $request->product_code_ev,
            'product_code_with_renew' => $request->product_code_with_renew,
            'product_name' => $request->product_name,
            'package_details_bn' => $request->package_details_bn,
        );

        if ($request->internet_id) {
//          dd($insertdata);
            $this->model->where('id', $request->internet_id)->update($insertdata);
        } else {
            return $this->model->insert($insertdata);
        }
    }

    public function saveExcelFile($request) {
        try {

            $request->validate([
                'package_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('package_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $totalCell = count($cells);
                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'country_en' => $cells[0]->getValue(),
                            'country_bn' => $cells[1]->getValue(),
                            'operator_en' => $cells[2]->getValue(),
                            'operator_bn' => $cells[3]->getValue(),
                            'tap_code' => $cells[4]->getValue(),
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata)) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "Roaming operator excel is uploaded successfully!"
                ];
            } else {
                $response = [
                    'success' => 0,
                    'message' => "Excel file format is not correct!"
                ];
            }


            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function statusChange($packageId) {
        try {
            $card = $this->model->findOrFail($packageId);
            $status = $card->status == 1 ? 0 : 1;
            $card->status = $status;
            $card->save();
            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function deleteOperator($operatorId) {
        try {
            if ($operatorId > 0) {
                $package = $this->model->findOrFail($operatorId);
                $package->delete();
            } else {
                $this->model->truncate();
            }

            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

}
