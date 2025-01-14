<?php

namespace App\Http\Controllers;

use App\Models\MyBlProductCategory;
use App\Models\SimCategory;
use App\Services\AlCoreProductService;
use App\Services\ProductCoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductEntryController extends Controller
{
    /**
     * @var ProductCoreService
     */
    protected $service;

    /**
     * @var AlCoreProductService
     */
    protected $alCoreProductService;

    /**
     * ProductEntryController constructor.
     * @param ProductCoreService $service
     * @param AlCoreProductService $alCoreProductService
     */
    public function __construct(ProductCoreService $service, AlCoreProductService $alCoreProductService)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->alCoreProductService = $alCoreProductService;
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
        $codes = $this->service->searchProductCodes($search_term)->pluck('product_code');

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
        try {
            $file = $request->file('product_file');
            $path = $file->storeAs(
                'products/' . strtotime(now() . '/'),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

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

    public function assetliteCoreProductForm()
    {
        return view('admin.core-product.core_product_entry');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assetliteCoreProductStore(Request $request)
    {
        try {
            $file = $request->file('excel_file');

            $path = $file->storeAs(
                'products/' . strtotime(now()),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->alCoreProductService->mapAssetliteProduct($path);

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
