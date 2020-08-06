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

    public function getOperatorList($request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $query = $this->model;


        $searchStr = $request->get('search');

        if ($searchStr['value'] != "") {
            $searchVal = $searchStr['value'];
            $query = $query->whereRaw("country_en Like '%$searchVal%' OR operator_en Like '%$searchVal%'");
        }




        $all_items_count = $query->count();
        $items = $query->skip($start)->take($length)->latest()->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {

           
            $response['data'][] = [
                'id' => $item->id,
                'country_en' => $item->country_en,
                'operator_en' => $item->operator_en,
                'tap_code' => $item->tap_code,
            ];
        });

        return $response;
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
                            'country_en' => trim($cells[0]->getValue()),
                            'country_bn' => trim($cells[1]->getValue()),
                            'operator_en' => trim($cells[2]->getValue()),
                            'operator_bn' => trim($cells[3]->getValue()),
                            'tap_code' => trim($cells[4]->getValue()),
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
                'message' => $e
            ];
            
            dd($e);
            return response()->json($response, 500);
        }
    }
    
      public function saveOperator($request) {
        $insertdata = array(
            'country_en' => $request->country_en,
            'country_bn' => $request->country_bn,
            'operator_en' => $request->operator_en,
            'operator_bn' => $request->operator_bn,
            'details_en' => $request->details_en,
            'details_bn' => $request->details_bn,
            'tap_code' => $request->tap_code,
        );

        if ($request->operator_id) {
//          dd($insertdata);
            $this->model->where('id', $request->operator_id)->update($insertdata);
        } else {
            return $this->model->insert($insertdata);
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
