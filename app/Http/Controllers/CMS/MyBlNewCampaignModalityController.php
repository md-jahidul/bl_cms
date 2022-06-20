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
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
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
    /**
     * @var MyBlInternetOffersCategoryService
     */
    private $productCategoryService;

    public function __construct(
        CampaignNewModalityService $campaignNewModalityService,
        BaseMsisdnService $baseMsisdnService,
        ProductCoreService $productCoreService,
        MyBlCampaignSectionService $blCampaignSectionService,
        MyBlInternetOffersCategoryService $productCategoryService
    ) {
        $this->campaignNewModalityService = $campaignNewModalityService;
        $this->productCoreService = $productCoreService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->blCampaignSectionService = $blCampaignSectionService;
        $this->productCategoryService = $productCategoryService;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $response = $this->campaignNewModalityService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect()->route('new-campaign-modality.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = $this->campaignNewModalityService->findOne($id);
        $campaignSection = $this->blCampaignSectionService->findAll();
        $campaignType = Helper::campaignType();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $partnerChannelNames = (json_decode($campaign['payment_channels']));
        $format = $campaign->recurring_type == 'none' ? 'Y/m/d h:i A' : 'Y/m/d';
        $dateRange = Carbon::parse($campaign->start_date)->format($format) . ' - ' .
            Carbon::parse($campaign->end_date)->format($format);
        $hourSlots = $this->campaignNewModalityService->getHourSlots();
        $products = $this->productCoreService->findAll();
        $page = 'edit';
//        dd($campaign);
        return view('admin.mybl-campaign.new-campaign-modality.edit',
            compact('campaign', 'baseMsisdnGroups', 'partnerChannelNames', 'hourSlots', 'page', 'dateRange', 'campaignSection', 'campaignType', 'products'));
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
        $response = $this->campaignNewModalityService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('own-recharge-inventory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->campaignNewModalityService->deleteCampaign($id);
        return url('new-campaign-modality');
    }
}
