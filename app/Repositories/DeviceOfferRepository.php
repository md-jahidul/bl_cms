<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 05/01/2020
 */

namespace App\Repositories;

use App\Models\DeviceOffer;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class DeviceOfferRepository extends BaseRepository {

    public $modelName = DeviceOffer::class;

    public function getBrandList() {
        $response = $this->model->select('brand')->groupBy('brand')->get();
        return $response;
    }

    public function getDeviceOfferList($request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->model->where('brand', '!=', NULL);

        if ($request->brand != null) {
            $builder->where('brand', $request->brand);
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
            $statusBtn = "<a href='$item->id' class='btn-sm btn-success offer_change_status'>Showing</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning offer_change_status'>Hidden</a>";
            }
            
            $freeData = "<small><strong>One:</strong> " . $item->free_data_one .
                "<br>" . "<strong>Two:</strong> " . $item->free_data_two .
                "<br>" . "<strong>Three:</strong> " . $item->free_data_three . "</small>";
            
            $bonusData = "<small><strong>One:</strong> " . $item->bonus_data_one .
                "<br>" . "<strong>Two:</strong> " . $item->bonus_data_two .
                "<br>" . "<strong>Three:</strong> " . $item->bonus_data_three . "</small>";
            
            $response['data'][] = [
                'id' => $item->id,
                'brand' => $item->brand,
                'model' => $item->model,
                'free_data' => $freeData,
                'bonus_data' => $bonusData,
                'available_shop' => $item->available_shop,
                'status' => $statusBtn
            ];
        });

        return $response;
    }

    public function saveExcelFile($request) {
        
        try {

            $request->validate([
                'offer_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('offer_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            $formatCheck = true;
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $totalCell = count($cells);

                    if ($totalCell != 9) {
                        $formatCheck = false;
                    }
                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'brand' => $cells[0]->getValue(),
                            'model' => $cells[1]->getValue(),
                            'free_data_one' => $cells[2]->getValue(),
                            'free_data_two' => $cells[3]->getValue(),
                            'free_data_three' => $cells[4]->getValue(),
                            'bonus_data_one' => $cells[5]->getValue(),
                            'bonus_data_two' => $cells[6]->getValue(),
                            'bonus_data_three' => $cells[7]->getValue(),
                            'available_shop' => $cells[8]->getValue()
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata) && $formatCheck == true) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "Device offer excel is uploaded successfully!"
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

    public function statusChange($offerId) {
        try {

            $card = $this->model->findOrFail($offerId);

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

    public function deleteOffer($offerId) {
        try {
            if ($offerId > 0) {
                $offer = $this->model->findOrFail($offerId);
                $offer->delete();
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
