<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\ProductPriceSlabService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProductPriceSlabController extends Controller
{
    /**
     * @var ProductPriceSlabService
     */
    private $priceSlabService;

    /**
     * ProductPriceSlabController constructor.
     * @param ProductPriceSlabService $priceSlabService
     */
    public function __construct(ProductPriceSlabService $priceSlabService)
    {
        $this->priceSlabService = $priceSlabService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.product.product-slab.list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadPriceSlabExcel(Request $request)
    {
        return $this->priceSlabService->saveExcel($request);
    }


    /**
     * @param $priceSlabId
     * @return Factory|View
     */
    public function priceSlabEdit($priceSlabId)
    {
        $priceSlab = $this->priceSlabService->findOne($priceSlabId);
        return view('admin.product.product-slab.edit', compact('priceSlab'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function updatePriceSlab(Request $request, $id)
    {
        $response = $this->priceSlabService->updatePriceSlab($request, $id);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Price slab is updated!');
        } else {
            Session::flash('error', 'PriceSlab updating process failed!');
        }
        return redirect('product-price/slabs');
    }


    public function priceSlabList(Request $request)
    {
        return $this->priceSlabService->getPriceSlab($request);
    }

//    public function priceSlabStatusChange($id)
//    {
//        return $this->priceSlabService->statusChange($id);
//    }

    public function allPriceSlabDelete()
    {
        return $this->priceSlabService->deletePriceSlabAll();
    }

    public function deletePriceSlab($priceSlabId = 0)
    {
        return $this->priceSlabService->deletePriceSlab($priceSlabId);
    }
}
