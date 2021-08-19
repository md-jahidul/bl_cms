<?php

namespace App\Http\Controllers\CMS;

use App\Models\MyBlProduct;
use App\Services\BaseMsisdnService;
use App\Services\MyblFlashHourService;
use App\Services\MyBlProductService;
use App\Services\MyblReferAndEarnService;
use App\Services\ProductCoreService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MyBlFlashHourController extends Controller
{
    /**
     * @var ProductCoreService
     */
    private $productCoreService;
    /**
     * @var MyblFlashHourService
     */
    private $myblFlashHourService;
    /**
     * @var BaseMsisdnService
     */
    private $baseMsisdnService;

    /**
     * MyBlFlashHourController constructor.
     * @param MyblFlashHourService $myblFlashHourService
     * @param ProductCoreService $productCoreService
     */
    public function __construct(
        MyblFlashHourService $myblFlashHourService,
        BaseMsisdnService $baseMsisdnService,
        ProductCoreService $productCoreService
    ) {
        $this->myblFlashHourService = $myblFlashHourService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->productCoreService = $productCoreService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $flashHourCampaigns = $this->myblFlashHourService->findAll();
        return view('admin.mybl-campaign.flash-hour.index', compact('flashHourCampaigns'));
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
        return view('admin.mybl-campaign.flash-hour.create-edit', compact('products', 'baseMsisdnGroups'));
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
        return redirect(route('flash-hour-campaign.index'));
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
        return view('admin.mybl-campaign.flash-hour.create-edit', compact('products', 'campaign', 'baseMsisdnGroups'));
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
        return redirect(route('flash-hour-campaign.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function getReferAndEarnAnalytics()
    {
        $analytics = $this->myblFlashHourService->analyticsData();
        return view('admin.mybl-campaign.flash-hour.analytics', compact('analytics'));
    }

    public function campaignDetails(Request $request, $campaignId)
    {
        $campaignDetails = $this->myblFlashHourService->detailsCampaign($request, $campaignId);
        return view('admin.mybl-campaign.flash-hour.campaign-details', compact('campaignDetails'));
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
        return url('flash-hour-campaign');
    }
}
