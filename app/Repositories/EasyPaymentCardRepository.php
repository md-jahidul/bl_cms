<?php

/**
 * Created by PhpStorm.
 * User: Bulbul Mahmud Nito
 * Date: 05/01/2020
 */

namespace App\Repositories;

use App\Models\EasyPaymentCard;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Support\Facades\Validator;

class EasyPaymentCardRepository extends BaseRepository {

    public $modelName = EasyPaymentCard::class;

    public function getDivisionList() {
        $divisions = $this->model->select('division')->groupBy('division')->get();
        return $divisions;
    }

    public function getPaymentCardList($request) {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = $this->model->where('division', '!=', NULL);

        if ($request->division != null) {
            $builder->where('division', $request->division);
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
            $statusBtn = "<a href='$item->id' class='btn-sm btn-success card_change_status'>Showing</a>";
            if ($item->status == 0) {
                $statusBtn = "<a href='$item->id' class='btn-sm btn-warning card_change_status'>Hidden</a>";
            }
            $response['data'][] = [
                'id' => $item->id,
                'code' => $item->code,
                'division' => $item->division,
                'area' => $item->area,
                'branch_name' => $item->branch_name,
                'address' => "<small>".$item->address,"</small>",
                'status' => $statusBtn
            ];
        });

        return $response;
    }

    public function saveExcelFile($request) {
        try {

            $request->validate([
                'card_file' => 'required|mimes:xls,xlsx'
            ]);

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $path = $request->file('card_file')->getRealPath();
            $reader->open($path);

            $insertdata = [];
            $formatCheck = true;
            foreach ($reader->getSheetIterator() as $sheet) {
                $rowNumber = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $totalCell = count($cells);

                    if ($totalCell != 5) {
                        $formatCheck = false;
                    }
                    if ($rowNumber > 1) {
                        $insertdata[] = array(
                            'code' => $cells[0]->getValue(),
                            'division' => $cells[1]->getValue(),
                            'area' => $cells[2]->getValue(),
                            'branch_name' => $cells[3]->getValue(),
                            'address' => $cells[4]->getValue(),
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata) && $formatCheck == true) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "Payment card excel is uploaded successfully!"
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

    public function statusChange($cardId) {
        try {

            $card = $this->model->findOrFail($cardId);

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

    public function deleteCards($cardId) {
        try {
            if ($cardId > 0) {
                $card = $this->model->findOrFail($cardId);
                $card->delete();
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
