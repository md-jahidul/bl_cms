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
                'data_volume' => $item->data_volume . " " . $item->volume_data_unit,
                'validity' => $item->validity . " " . $item->validity_unit,
                'activation_ussd_code' => $item->activation_ussd_code,
                'balance_check_ussd_code' => $item->balance_check_ussd_code,
                'mrp' => $item->mrp,
                'home_show' => $homeShow,
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

    public function saveInternet($bannerPath, $request) {



        $insertdata = array(
            'product_code' => $request->product_code,
            'product_code_ev' => $request->product_code_ev,
            'product_code_with_renew' => $request->product_code_with_renew,
            'product_name' => $request->product_name,
            'package_details_bn' => $request->package_details_bn,
            'package_details_en' => $request->package_details_en,
            'product_commercial_name_en' => $request->product_commercial_name_en,
            'product_commercial_name_bn' => $request->product_commercial_name_bn,
            'product_short_description' => $request->product_short_description,
            'activation_ussd_code' => $request->activation_ussd_code,
            'balance_check_ussd_code' => $request->balance_check_ussd_code,
            'data_volume' => $request->data_volume,
            'volume_data_unit' => $request->volume_data_unit,
            'validity' => $request->validity,
            'validity_unit' => $request->validity_unit,
            'mrp' => $request->mrp,
            'price' => $request->price,
            'Tax' => $request->Tax,
            'is_amar_offer' => $request->is_amar_offer == 1 ? $request->is_amar_offer : 0,
            'rate_cutter_offer_rate' => $request->rate_cutter_offer_rate,
            'rate_cutter_offer_unit' => $request->rate_cutter_offer_unit,
            'offer_type' => $request->offer_type,
            'short_text' => $request->short_text,
            'alt_text' => $request->alt_text,
            'tag_id' => $request->tag,
            'related_product' => implode(',', $request->related_product_id),
        );
        
        if($bannerPath != ""){
              $insertdata['banner_photo'] = $bannerPath;
        }
        
        if($request->internet_id){
//          dd($insertdata);
             $this->model->where('id', $request->internet_id)->update($insertdata);
        }else{
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
                            'product_code' => $cells[0]->getValue(),
                            'product_code_ev' => $cells[1]->getValue(),
                            'product_code_with_renew' => $cells[2]->getValue(),
                            'product_name' => $cells[3]->getValue(),
                            'product_commercial_name_en' => $cells[4]->getValue(),
                            'product_commercial_name_bn' => $cells[5]->getValue(),
                            'product_short_description' => $cells[6]->getValue(),
                            'activation_ussd_code' => $cells[7]->getValue(),
                            'balance_check_ussd_code' => $cells[8]->getValue(),
                            'data_volume' => $cells[9]->getValue(),
                            'volume_data_unit' => $cells[10]->getValue(),
                            'validity' => $cells[11]->getValue(),
                            'validity_unit' => $cells[12]->getValue(),
                            'mrp' => $cells[13]->getValue(),
                            'price' => $cells[14]->getValue(),
                            'Tax' => $cells[15]->getValue(),
                            'is_amar_offer' => $cells[16]->getValue(),
                            'rate_cutter_offer_rate' => $cells[17]->getValue(),
                            'rate_cutter_offer_unit' => $cells[18]->getValue(),
                            'offer_type' => $cells[19]->getValue(),
                            'short_text' => $cells[20]->getValue(),
                            'sms_rate_unit' => $cells[21]->getValue()
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

            $internet = $this->model->findOrFail($packageId);

            $status = $internet->home_show == 1 ? 0 : 1;
            $internet->home_show = $status;
            $internet->save();

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
