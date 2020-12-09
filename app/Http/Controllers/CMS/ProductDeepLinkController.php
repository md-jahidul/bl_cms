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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductDeepLink  $productDeepLink
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDeepLink $productDeepLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductDeepLink  $productDeepLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDeepLink $productDeepLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductDeepLink  $productDeepLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDeepLink $productDeepLink)
    {
        //
    }
}
