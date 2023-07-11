<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyBlFreeProductDisburseController extends Controller
{
    public function __construct()
    {

    }

    public function freeProductDisburseUploadPanel()
    {
        return view('admin.free-product-disburse');
    }

    public function uploadFreeProductDisburseExcel(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'free_product_disburse_file' => 'required|file|mimes:xlsx',
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
            $path = $request->file('free_product_disburse_file')->store(
                'free_product_disburse_file/' . date('y-m-d'),
                'public'
            );

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }
}
