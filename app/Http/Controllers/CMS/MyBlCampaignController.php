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

class MyBlCampaignController extends Controller
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

    protected const MYBL_CAMPAIGN = "mybl_campaign";

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
        $flashHourCampaigns = $this->myblFlashHourService->findBy(['reference_type' => self::MYBL_CAMPAIGN]);
        return view('admin.mybl-campaign.mybl-campaign.index', compact('flashHourCampaigns'));
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
        return view('admin.mybl-campaign.mybl-campaign.create-edit', compact('products', 'baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->myblFlashHourService->storeCampaign($request->all(), self::MYBL_CAMPAIGN);
        Session::flash('message', $response->getContent());
        return redirect(route('mybl-campaign.index'));
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
        return view('admin.mybl-campaign.mybl-campaign.create-edit', compact('products', 'campaign', 'baseMsisdnGroups'));
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
        return redirect(route('mybl-campaign.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function analyticReport(Request $request, $campaignId)
    {
        $analytics = $this->myblFlashHourService->analyticsData($request->all(), $campaignId);
        return view('admin.mybl-campaign.mybl-campaign.analytic-report.purchase-product', compact('analytics', 'campaignId'));
    }

    public function purchaseMsisdnList(Request $request, $campaignId, $purchaseProductId)
    {
        if ($request->ajax()) {
            return $this->myblFlashHourService->msisdnPurchaseDetails($request, $purchaseProductId);
        }
        return view('admin.mybl-campaign.mybl-campaign.analytic-report.purchase-msisdn', compact('campaignId'));
    }

    public function purchaseDetails(Request $request, $id)
    {
        return $this->myblFlashHourService->msisdnPurchaseDetails($request, $id);
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
        return url('mybl-campaign');
    }
}
