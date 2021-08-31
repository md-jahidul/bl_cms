<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyblCashBackService;
use App\Services\ProductCoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MyBlCashBackController extends Controller
{
    /**
     * @var MyblCashBackService
     */
    private $myblCashBackService;
    /**
     * @var ProductCoreService
     */
    private $productCoreService;

    /**
     * MyBlCashBackController constructor.
     * @param MyblCashBackService $myblCashBackService
     * @param ProductCoreService $productCoreService
     */
    public function __construct(
        MyblCashBackService $myblCashBackService,
        ProductCoreService $productCoreService
    ) {
        $this->myblCashBackService = $myblCashBackService;
        $this->productCoreService = $productCoreService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $flashHourCampaigns = $this->myblCashBackService->findAll();
        return view('admin.mybl-campaign.cash-back.index', compact('flashHourCampaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->myblCashBackService->findAll();
        return view('admin.mybl-campaign.cash-back.create-edit', compact('products', 'baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->myblFlashHourService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('cash-back-campaign.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $products = $this->productCoreService->findAll();
        $campaign = $this->myblFlashHourService->findOne($id);
        return view('admin.mybl-campaign.cash-back.create-edit', compact('products', 'campaign', 'baseMsisdnGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->myblFlashHourService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('cash-back-campaign.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function getReferAndEarnAnalytics()
    {
        $analytics = $this->myblFlashHourService->analyticsData();
        return view('admin.mybl-campaign.cash-back.analytics', compact('analytics'));
    }

    public function campaignDetails(Request $request, $campaignId)
    {
        $campaignDetails = $this->myblFlashHourService->detailsCampaign($request, $campaignId);
        return view('admin.mybl-campaign.cash-back.campaign-details', compact('campaignDetails'));
    }

    public function refereeDetails(Request $request, $id)
    {
        return $this->myblFlashHourService->refereeDetails($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function destroy($id)
    {
        $this->myblFlashHourService->deleteCampaign($id);
        return url('cash-back-campaign');
    }
}
