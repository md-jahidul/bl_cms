<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\BusinessInternet;
use Box\Spout\Common\Type;
use App\Traits\FileTrait;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Support\Facades\Auth;

class BusinessInternetRepository extends BaseRepository {

    public $modelName = BusinessInternet::class;

    use FileTrait;

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
                'type' => $item->type,
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

    public function saveInternet($bannerWeb, $bannerMob, $request) {
        $businessInternet =  $this->model;
        $insertdata = array(
            'type' => $request->type,
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
            'alt_text_bn' => $request->alt_text_bn,
            'banner_name' => $request->banner_name,
            'banner_name_bn' => $request->banner_name_bn,
            'url_slug' => $request->url_slug,
            'url_slug_bn' => $request->url_slug_bn,
            'schema_markup' => $request->schema_markup,
            'page_header' => $request->page_header,
            'page_header_bn' => $request->page_header_bn,
            'tag_id' => $request->tag,
            'related_product' => $request->related_product_id!= "" ? implode(',', $request->related_product_id) : "",
        );

        if($bannerWeb != ""){
              $insertdata['banner_photo'] = $bannerWeb;
        }
        if($bannerMob != ""){
              $insertdata['banner_image_mobile'] = $bannerMob;
        }

        if($request->internet_id){
             $insertdata['updated_by'] = Auth::id();
            $businessInternet = $this->model->where('id', $request->internet_id)->first();
            $businessInternet->update($insertdata);
        }else{
            $insertdata['created_by'] = Auth::id();
           $businessInternet = $this->model->create($insertdata);
        }
        return $businessInternet;

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

                    $urlSlug = str_replace(' ', '-', $cells[4]->getValue());
                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'type' => $cells[0]->getValue(),
                            'product_code' => $cells[1]->getValue(),
                            'product_code_ev' => $cells[2]->getValue(),
                            'product_code_with_renew' => $cells[3]->getValue(),
                            'product_name' => $cells[4]->getValue(),
                            'product_commercial_name_en' => $cells[5]->getValue(),
                            'product_commercial_name_bn' => $cells[6]->getValue(),
                            'product_short_description' => $cells[7]->getValue(),
                            'activation_ussd_code' => $cells[8]->getValue(),
                            'balance_check_ussd_code' => $cells[9]->getValue(),
                            'data_volume' => $cells[10]->getValue(),
                            'volume_data_unit' => $cells[11]->getValue(),
                            'validity' => $cells[12]->getValue(),
                            'validity_unit' => $cells[13]->getValue(),
                            'mrp' => $cells[14]->getValue(),
                            'price' => $cells[15]->getValue(),
                            'Tax' => $cells[16]->getValue(),
                            'is_amar_offer' => $cells[17]->getValue(),
                            'rate_cutter_offer_rate' => $cells[18]->getValue(),
                            'rate_cutter_offer_unit' => $cells[19]->getValue(),
                            'offer_type' => $cells[20]->getValue(),
                            'short_text' => $cells[21]->getValue(),
                            'sms_rate_unit' => $cells[22]->getValue(),
                            'url_slug' => $urlSlug,
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

    public function deletePackage($packageId) {
        try {
            if ($packageId > 0) {
                $package = $this->model->findOrFail($packageId);
                $this->deleteFile($package->banner_photo);
                $package->delete();
                $package->searchableFeature()->delete();
            } else {

                $allPack = $this->model->get();
                foreach($allPack as $int){
                    $this->deleteFile($int->banner_photo);
                    $int->searchableFeature()->delete();
                }
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
