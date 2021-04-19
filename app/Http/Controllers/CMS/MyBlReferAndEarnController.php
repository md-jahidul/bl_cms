<?php

namespace App\Http\Controllers\CMS;

use App\Models\MyBlProduct;
use App\Services\MyBlProductService;
use App\Services\MyblReferAndEarnService;
use App\Services\ProductCoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MyBlReferAndEarnController extends Controller
{
    /**
     * @var \App\Services\MyblReferAndEarnService
     */
    private $referAndEarnService;
    /**
     * @var ProductCoreService
     */
    private $productCoreService;

    /**
     * MyBlReferAndEarnController constructor.
     * @param \App\Services\MyblReferAndEarnService $referAndEarnService
     */
    public function __construct(
        MyblReferAndEarnService $referAndEarnService,
        ProductCoreService $productCoreService
    ) {
        $this->referAndEarnService = $referAndEarnService;
        $this->productCoreService = $productCoreService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $referEarnCampaigns = $this->referAndEarnService->findAll();
        return view('admin.mybl-refer-and-earn.campaign.index', compact('referEarnCampaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $products = $this->productCoreService->findAll();
        return view('admin.mybl-refer-and-earn.campaign.create-edit', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $response = $this->referAndEarnService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('mybl-refer-and-earn.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $products = $this->productCoreService->findAll();
        $campaign = $this->referAndEarnService->findOne($id);
        return view('admin.mybl-refer-and-earn.campaign.create-edit', compact('products', 'campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
