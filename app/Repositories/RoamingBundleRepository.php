<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Repositories;

use App\Models\RoamingBundleOffer;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class RoamingBundleRepository extends BaseRepository {

    public $modelName = RoamingBundleOffer::class;

    public function getBundleList($request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $query = $this->model;

        $searchStr = $request->get('search');

        if ($searchStr['value'] != "") {
            $searchVal = $searchStr['value'];
            $query = $query->whereRaw("product_code Like '%$searchVal%' OR country Like '%$searchVal%' OR operator Like '%$searchVal%' OR package_name_en Like '%$searchVal%'");
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
                'product_code' => $item->product_code,
                'subscription_type' => $item->subscription_type,
                'country' => $item->country,
                'operator' => $item->operator,
                'package_name_en' => $item->package_name_en,
            ];
        });

        return $response;
    }

    public function getInternetById($internetId) {
        return $this->model->findOrFail($internetId);
    }

    public function getAllPackage($internetId) {
        $allProducts = $this->model->select('id', 'product_code', 'product_name')->where('status', 1);
        if ($internetId > 0) {
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
        );
        if ($request->internet_id) {
            $this->model->where('id', $request->internet_id)->update($insertdata);
        } else {
            return $this->model->insert($insertdata);
        }
    }

    public function saveExcelFile($request) {
        try {
            $request->validate([
                'bundle_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('bundle_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $totalCell = count($cells);

                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'product_code' => trim($cells[0]->getValue()),
                            'subscription_type' => trim($cells[1]->getValue()),
                            'country' => trim($cells[2]->getValue()),
                            'operator' => trim($cells[3]->getValue()),
                            'package_name_en' => trim($cells[4]->getValue()),
                            'package_name_bn' => trim($cells[5]->getValue()),
                            'data_volume' => trim($cells[6]->getValue()),
                            'volume_data_unit' => trim($cells[7]->getValue()),
                            'sms_volume' => trim($cells[8]->getValue()),
                            'minute_volume' => trim($cells[9]->getValue()),
                            'validity' => trim($cells[10]->getValue()),
                            'validity_unit' => trim($cells[11]->getValue()),
                            'mrp' => trim($cells[12]->getValue()),
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata)) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "Roaming bundle excel is uploaded successfully!"
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

    public function deleteBundle($operatorId) {
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
