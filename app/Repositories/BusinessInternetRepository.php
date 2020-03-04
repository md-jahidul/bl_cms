<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessInternet;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class BusinessInternetRepository extends BaseRepository {

    public $modelName = BusinessInternet::class;

    public function getInternetPackageList($request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->model;


        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            
            $homeShow = "<a href='$item->id' class='btn-sm btn-success package_home_show'>Showing</a>";
            if ($item->home_show == 0) {
                $homeShow = "<a href='$item->id' class='btn-sm btn-warning package_home_show'>Hidden</a>";
            }
            
            $statusBtn = "<a href='$item->id' class='btn-sm btn-success package_change_status'>Active</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning package_change_status'>Inactive</a>";
            }

            $freeData = "<small><strong>One:</strong> " . $item->free_data_one .
                    "<br>" . "<strong>Two:</strong> " . $item->free_data_two .
                    "<br>" . "<strong>Three:</strong> " . $item->free_data_three . "</small>";

            $bonusData = "<small><strong>One:</strong> " . $item->bonus_data_one .
                    "<br>" . "<strong>Two:</strong> " . $item->bonus_data_two .
                    "<br>" . "<strong>Three:</strong> " . $item->bonus_data_three . "</small>";

            $response['data'][] = [
                'id' => $item->id,
                'data_volume' => $item->data_volume." ".$item->volume_data_unit,
                'validity' => $item->validity. " ". $item->validity_unit,
                'activation_ussd_code' => $item->activation_ussd_code,
                'balance_check_ussd_code' => $item->balance_check_ussd_code,
                'mrp' => $item->mrp,
                'home_show' => $homeShow,
                'status' => $statusBtn
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
                            'type' => $cells[0]->getValue(),
                            'content' => $cells[1]->getValue(),
                            'product_family' => $cells[2]->getValue(),
                            'product_code' => $cells[3]->getValue(),
                            'product_code_ev' => $cells[4]->getValue(),
                            'product_code_with_renew' => $cells[5]->getValue(),
                            'product_name' => $cells[6]->getValue(),
                            'product_commercial_name_en' => $cells[7]->getValue(),
                            'product_commercial_name_bn' => $cells[8]->getValue(),
                            'product_short_description' => $cells[9]->getValue(),
                            'activation_ussd_code' => $cells[10]->getValue(),
                            'balance_check_ussd_code' => $cells[11]->getValue(),
                            'offer_id' => $cells[12]->getValue(),
                            'sms_volume' => $cells[13]->getValue(),
                            'minutes_volume' => $cells[14]->getValue(),
                            'data_volume' => $cells[15]->getValue(),
                            'volume_data_unit' => $cells[16]->getValue(),
                            'validity' => $cells[17]->getValue(),
                            'validity_unit' => $cells[18]->getValue(),
                            'mrp' => $cells[19]->getValue(),
                            'price' => $cells[20]->getValue(),
                            'Tax' => $cells[21]->getValue(),
                            'is_amar_offer' => $cells[22]->getValue(),
                            'is_auto_renewable' => $cells[23]->getValue(),
                            'is_recharge_offer' => $cells[24]->getValue(),
                            'is_gift_offer' => $cells[25]->getValue(),
                            'rate_cutter_offer_rate' => $cells[26]->getValue(),
                            'rate_cutter_offer_unit' => $cells[27]->getValue(),
                            'offer_type' => $cells[28]->getValue(),
                            'short_text' => $cells[29]->getValue(),
                            'sms_rate_unit' => $cells[30]->getValue()
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata)) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "Internet package excel is uploaded successfully!"
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
    
    
    public function homeShow($packageId) {
        try {

            $card = $this->model->findOrFail($packageId);

            $status = $card->home_show == 1 ? 0 : 1;
            $card->home_show = $status;
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
    
    
    public function deletePackage($packageId) {
        try {
            if ($packageId > 0) {
                $package = $this->model->findOrFail($packageId);
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
