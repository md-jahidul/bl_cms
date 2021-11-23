<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreEventBasedCampaignRequest;
use App\Services\EventBaseBonusV2CampaignService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Services\EventBaseBonusChallengeService;
use Illuminate\Support\Facades\Session;

class EventBaseCampaignV2Controller extends Controller
{
    private $productCoreService;
    private $campaignService;
    private $taskService;
    private $challengeService;

    public function __construct(EventBaseBonusV2CampaignService $campaignService, ProductCoreService $productCoreService, TaskService $taskService, EventBaseBonusChallengeService $challengeService)
    {
        $this->middleware('auth');
        $this->productCoreService = $productCoreService;
        $this->campaignService = $campaignService;
        $this->taskService = $taskService;
        $this->challengeService = $challengeService;
    }

    public function index()
    {
        $campaigns = $this->campaignService->findAll();

        return view('admin.event-base-bonus.campaigns.v2.index', compact('campaigns'));
    }

    public function create()
    {
        $products = $this->productCoreService->findAll();
        $challenges = $this->challengeService->findAll();

        return view('admin.event-base-bonus.campaigns.v2.create', compact('products', 'challenges'));
    }

    public function store(StoreEventBasedCampaignRequest $request)
    {
        $response = $this->campaignService->store($request->except('_token'));

        Session::flash('message', 'Campaign store successful');
        return redirect('/event-base-bonus/v2/campaigns');
    }


    public function edit($id)
    {
        $campaign = $this->campaignService->findOne($id);
        $products = $this->productCoreService->findAll();
        $challenges = $this->challengeService->findAll();
        $challengeIds = array_column($campaign['challenges'], 'id');

        return view('admin.event-base-bonus.campaigns.v2.edit', compact('campaign', 'products', 'challenges', 'challengeIds'));
    }

    public function update(StoreEventBasedCampaignRequest $request, $id)
    {
        $response = $this->campaignService->update($request->except('_token', '_method'), $id);
        Session::flash('message', 'Updated successful');

        return redirect('/event-base-bonus/v2/campaigns');
    }

    public function delete($id)
    {
        return $this->campaignService->delete($id);
    }
}
