<?php

namespace App\Http\Controllers;

use App\Models\MyBlProductCategory;
use App\Models\SimCategory;
use App\Services\ProductCoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductEntryController extends Controller
{
    /**
     * @var ProductCoreService
     */
    protected $service;

    public function __construct(ProductCoreService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function test()
    {
        try {
            $path = '/home/bs104/Desktop/product_sample.xlsx';
            $this->service->mapDataFromExcel($path);

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

    public function searchProductCodes(Request $request)
    {
        $search_term = $request->term;
        $codes = $this->service->searchProductCodes($search_term)->pluck('code');

        $data = [];

        foreach ($codes as $code) {
            $data ['results'][] = [
              'id'   => $code,
              'text' => $code,
            ];
        }

        return $data;
    }

    public function getProductDetails(Request $request)
    {
        return $this->service->getProductDetails($request->product_code);
    }
    public function index()
    {
        return view('product_entry');
    }

    public function uploadProductByExcel(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'product_file' => 'required|file|mimes:xlsx',
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
            $path = $request->file('product_file')->store(
                'products/' . date('y-m-d'),
                'public'
            );

            $this->service->mapDataFromExcel($path);

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
