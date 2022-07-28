<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Services\CampaignNewModalityService;
use App\Services\MyBlInternetOffersCategoryService;
use App\Services\NewCampaignModality\MyBlCampaignSectionService;
use App\Services\ProductCoreService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MyBlNewCampaignModalityController extends Controller
{
    protected $productCoreService, $baseMsisdnService;
    /**
     * @var CampaignNewModalityService
     */
    private $campaignNewModalityService;
    /**
     * @var MyBlCampaignSectionService
     */
    private $blCampaignSectionService;

    public function __construct(
        CampaignNewModalityService $campaignNewModalityService,
        BaseMsisdnService $baseMsisdnService,
        ProductCoreService $productCoreService,
        MyBlCampaignSectionService $blCampaignSectionService
    ) {
        $this->campaignNewModalityService = $campaignNewModalityService;
        $this->productCoreService = $productCoreService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->blCampaignSectionService = $blCampaignSectionService;
    }


    public function index()
    {
        $cashBackCampaigns = $this->campaignNewModalityService->findAll();
        return view('admin.mybl-campaign.new-campaign-modality.index', compact('cashBackCampaigns'));
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
        $hourSlots = $this->campaignNewModalityService->getHourSlots();
        $campaignType = Helper::campaignType();
        $campaignSection = $this->blCampaignSectionService->findAll();
        $productCategories = Helper::productCategories();
        return view(
            'admin.mybl-campaign.new-campaign-modality.create',
            compact('products', 'baseMsisdnGroups', 'hourSlots', 'campaignType', 'campaignSection', 'productCategories')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->campaignNewModalityService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('new-campaign-modality.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $campaign = $this->campaignNewModalityService->findOne($id);
        $campaignSection = $this->blCampaignSectionService->findAll();
        $campaignType = Helper::campaignType();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $partnerChannelNames = (json_decode($campaign['payment_channels']));
        $format = $campaign->recurring_type == 'none' ? 'Y/m/d h:i A' : 'Y/m/d';
//        $dateRange = Carbon::parse($campaign->start_date)->format($format) . ' - ' .
//            Carbon::parse($campaign->end_date)->format($format);
        $hourSlots = $this->campaignNewModalityService->getHourSlots();
        $products = $this->productCoreService->findAll();
        $productCategories = Helper::productCategories();
        $page = 'edit';

        return view(
            'admin.mybl-campaign.new-campaign-modality.edit',
            compact(
                'campaign',
                'baseMsisdnGroups',
                'partnerChannelNames',
                'hourSlots',
                'page',
                'campaignSection',
                'campaignType',
                'products',
                'productCategories'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->campaignNewModalityService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect()->back();
    }

    public function analyticReport(Request $request, $campaignId)
    {
        $campaign = $this->campaignNewModalityService->findOne($campaignId);
        $analytics = $this->campaignNewModalityService->analyticsData($request->all(), $campaignId);

        return view('admin.mybl-campaign.new-campaign-modality.analytic-report.purchase-product', compact('analytics', 'campaign'));
    }

    public function purchaseMsisdnList(Request $request, $campaignId, $purchaseProductId)
    {
        if ($request->ajax()) {
            return $this->campaignNewModalityService->msisdnPurchaseDetails($request, $purchaseProductId);
        }
        return view('admin.mybl-campaign.new-campaign-modality.analytic-report.purchase-msisdn', compact('campaignId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string|UrlGenerator
     */
    public function destroy($id)
    {
        $this->campaignNewModalityService->deleteCampaign($id);
        return url('new-campaign-modality');
    }
}
