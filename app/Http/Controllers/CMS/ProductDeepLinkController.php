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
     * @return array
     */
    public function data(Request $request): array
    {
        return $this->productDeepLinkService->getProductDeepLinkListReport($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductDeepLink  $productDeepLink
     * @return \Illuminate\Http\Response
     */
    public function show(ProductDeepLink $productDeepLink)
    {
        //
    }


}
