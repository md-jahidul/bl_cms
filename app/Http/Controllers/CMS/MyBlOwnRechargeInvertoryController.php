<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\BaseMsisdnService;
use App\Services\MyblOwnRechargeInventoryService;
use App\Services\OwnRechargeWinningCappintService;
use App\Services\ProductCoreService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class MyBlOwnRechargeInvertoryController extends Controller
{
    protected $ownRechargeInventoryService, $productCoreService, $baseMsisdnService, $ownRechargeWinningCappingService;

    public function __construct(
        MyblOwnRechargeInventoryService $ownRechargeInventoryService, 
        BaseMsisdnService $baseMsisdnService,
        ProductCoreService $productCoreService,
        OwnRechargeWinningCappintService $ownRechargeWinningCappingService
    ) {
        $this->ownRechargeInventoryService      = $ownRechargeInventoryService;
        $this->productCoreService               = $productCoreService;
        $this->baseMsisdnService                = $baseMsisdnService;
        $this->ownRechargeWinningCappingService = $ownRechargeWinningCappingService;
    }


    public function index()
    {
        $cashBackCampaigns = $this->ownRechargeInventoryService->findAll();
        return view('admin.mybl-campaign.own-recharge-inventory.index', compact('cashBackCampaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $hourSlots = $this->ownRechargeInventoryService->getHourSlots();

        return view('admin.mybl-campaign.own-recharge-inventory.create', compact('products', 'baseMsisdnGroups', 'hourSlots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->ownRechargeInventoryService->storeCampaign($request->all());
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
        $campaign = $this->ownRechargeInventoryService->findOne($id);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $partnerChannelNames = (json_decode($campaign['partner_channel_names']));
        $format = $campaign->recurring_type == 'none' ? 'Y/m/d h:i A' : 'Y/m/d';
        $dateRange = Carbon::parse($campaign->start_date)->format($format) . ' - ' .
            Carbon::parse($campaign->end_date)->format($format);
        $hourSlots = $this->ownRechargeInventoryService->getHourSlots();
        $page = 'edit';
        $winningCampaignLogics = $this->ownRechargeWinningCappingService->find($campaign->id);
        return view('admin.mybl-campaign.own-recharge-inventory.edit', compact('campaign', 'baseMsisdnGroups', 'partnerChannelNames', 'hourSlots', 'page', 'dateRange', 'winningCampaignLogics'));
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
        $response = $this->ownRechargeInventoryService->updateCampaign($request->all(), $id);
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
        $this->ownRechargeInventoryService->deleteCampaign($id);
        return url('own-recharge-inventory');
    }
}
