<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Services\CampaignNewModalityService;
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
    protected $productCoreService, $baseMsisdnService, $ownRechargeWinningCappingService;
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
//        OwnRechargeWinningCappintService $ownRechargeWinningCappingService
    ) {
        $this->campaignNewModalityService      = $campaignNewModalityService;
        $this->productCoreService               = $productCoreService;
        $this->baseMsisdnService                = $baseMsisdnService;
        $this->blCampaignSectionService                = $blCampaignSectionService;
//        $this->ownRechargeWinningCappingService = $ownRechargeWinningCappingService;
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
        return view(
            'admin.mybl-campaign.new-campaign-modality.create',
            compact('products', 'baseMsisdnGroups', 'hourSlots', 'campaignType', 'campaignSection')
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
        $response = $this->campaignNewModalityService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('own-recharge-inventory.index'));
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
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $partnerChannelNames = (json_decode($campaign['partner_channel_names']));
        $format = $campaign->recurring_type == 'none' ? 'Y/m/d h:i A' : 'Y/m/d';
        $dateRange = Carbon::parse($campaign->start_date)->format($format) . ' - ' .
            Carbon::parse($campaign->end_date)->format($format);
        $hourSlots = $this->campaignNewModalityService->getHourSlots();
        $page = 'edit';
//        $winningCampaignLogics = $this->ownRechargeWinningCappingService->find($campaign->id);
        return view('admin.mybl-campaign.new-campaign-modality.edit', compact('campaign', 'baseMsisdnGroups', 'partnerChannelNames', 'hourSlots', 'page', 'dateRange'));
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
        return url('own-recharge-inventory');
    }
}
