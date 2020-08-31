<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\University;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class UniversityRepository extends BaseRepository
{
    public $modelName = University::class;

    public function getUniversityList($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $query = $this->model;


        $searchStr = $request->get('search');

        if ($searchStr['value'] != "") {
            $searchVal = $searchStr['value'];
            $query = $query->whereRaw("university_name Like '%$searchVal%'");
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
                'university_name' => $item->university_name,
//                'operator_en' => $item->operator_en,
//                'tap_code' => $item->tap_code,
            ];
        });

        return $response;
    }

    public function saveExcelFile($request)
    {
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
                            'university_name' => trim($cells[0]->getValue()),
                            'university_slug' => str_replace([' ', ',', '.'], '_', strtolower(trim($cells[0]->getValue()))),
                        );
                    }
                    $rowNumber++;
                }
            }


            if (!empty($insertdata)) {
                $this->model->insert($insertdata);
                $response = [
                    'success' => 1,
                    'message' => "University excel is uploaded successfully!"
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

    public function deleteUniversity($id) {
        try {
            if ($id > 0) {
                $package = $this->model->findOrFail($id);
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
