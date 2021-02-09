<?php

namespace App\Http\Controllers\CMS;

use App\ProductDeepLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductDeepLinkService;

class ProductDeepLinkController extends Controller
{

    /**
     * @var ProductDeepLinkService
     */
    protected $productDeepLinkService;

    /**
     * PushNotificationController constructor.
     * @param ProductDeepLinkService $productDeepLinkService
     */
    public function __construct(ProductDeepLinkService $productDeepLinkService)
    {
        $this->productDeepLinkService = $productDeepLinkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product-deep-link-report.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_code)
    {
        return $this->productDeepLinkService->createDeepLink($product_code);
    }

    /**
     * @param Request $request
     * @return mixedgetDetails
     */
    public function data(Request $request)
    {
        if ($request->has('searchByFromdate') || $request->has('searchByTodate') || $request->has('searchByProductCode')) {
            return $this->productDeepLinkService->getProductDeepLinkfilterList($request);
        } else {
            return $this->productDeepLinkService->getProductDeepLinkListReport($request);
        }

    }

    /**
     * @param Request $request
     * @param null $productDeeplinkDbId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function getDetails(Request $request, $productDeeplinkDbId = null)
    {
        $from = ($request->has('from')) ? $request->input('from') : null;
        $to = ($request->has('to')) ? $request->input('to') : null;
        if ($request->has('draw')) {
            return $this->productDeepLinkService->getProductDeepLinkDetailsReport($request, $productDeeplinkDbId);
        }
        return view('admin.product-deep-link-report.details', compact('productDeeplinkDbId', 'from', 'to'));
    }


}
