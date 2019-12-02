<?php

namespace App\Http\Controllers;

use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function excel()
    {
        return view('demo');
    }

    public function fileUpload()
    {
    }

    public function uploadCustomerByExcel(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'customer_file' => 'required|file|mimes:xlsx',
            ]
        );

        if ($validate->fails()) {
            $response = [
                'success' => 'FAILED',
                'errors' => $validate->errors()->first()
            ];
            return response()->json($response, 422);
        }

        try {
            $path = $request->file('customer_file')->store(
                'customers/' . date('y-m-d'),
                'public'
            );

            //dd(public_path('storage/' . $path));


            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files

            $file_path = Storage::disk('public')->path($path);

            $reader->open($file_path);

           // $reader->open(asset('e6t3c0jNIRcxi3JWGo158COCWocTVYPyVvrI09kt.xlsx'));

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    // do stuff with the row

                    $cells = $row->getCells();

                    foreach ($cells as $cell) {
                        echo "<pre>";
                        print_r($cell->getValue());
                    }
                }
            }

            $reader->close();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
