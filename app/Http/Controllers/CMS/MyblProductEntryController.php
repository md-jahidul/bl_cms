<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ProductCoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyblProductEntryController extends Controller
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
        return view('admin.my-bl-products.mybl_product_entry');
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

            $this->service->mapMyBlProduct($path);

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

    public function getMyblProducts(Request $request)
    {
        return $this->service->getMyblProducts($request);
    }
}
