<?php

namespace App\Http\Controllers\CMS;

use App\Models\MyBlProduct;
use App\Services\BaseMsisdnService;
use App\Services\MyBlProductService;
use App\Services\MyblReferAndEarnService;
use App\Services\ProductCoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MyBlReferAndEarnController extends Controller
{
    protected $baseMsisdnService;
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
        ProductCoreService $productCoreService,
        BaseMsisdnService $baseMsisdnService
    ) {
        $this->referAndEarnService = $referAndEarnService;
        $this->productCoreService = $productCoreService;
        $this->baseMsisdnService = $baseMsisdnService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $orderBy = ['column' => "id", 'direction' => 'desc'];
        $referEarnCampaigns = $this->referAndEarnService->findAll('', '', $orderBy);
        return view('admin.mybl-campaign.refer-and-earn.index', compact('referEarnCampaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        return view('admin.mybl-campaign.refer-and-earn.create-edit', compact('products', 'baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $response = $this->referAndEarnService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('mybl-refer-and-earn.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $products = $this->productCoreService->findAll();
        $campaign = $this->referAndEarnService->findOne($id);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        return view('admin.mybl-campaign.refer-and-earn.create-edit', compact('products', 'campaign', 'baseMsisdnGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->referAndEarnService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('mybl-refer-and-earn.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function getReferAndEarnAnalytics()
    {
        $analytics = $this->referAndEarnService->analyticsData();
        return view('admin.mybl-campaign.refer-and-earn.analytics', compact('analytics'));
    }

    public function campaignDetails(Request $request, $campaignId)
    {
        $campaignDetails = $this->referAndEarnService->detailsCampaign($request, $campaignId);
        return view('admin.mybl-campaign.refer-and-earn.campaign-details', compact('campaignDetails'));
    }

    public function refereeDetails(Request $request, $id)
    {
        return $this->referAndEarnService->refereeDetails($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function destroy($id)
    {
        $this->referAndEarnService->deleteCampaign($id);
        return url('mybl-refer-and-earn');
    }
}
