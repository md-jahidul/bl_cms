<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreEventBasedCampaignRequest;
use App\Services\BaseMsisdnService;
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
    private $baseMsisdnService;

    /**
     * @param BaseMsisdnService $baseMsisdnService
     * @param EventBaseBonusV2CampaignService $campaignService
     * @param ProductCoreService $productCoreService
     * @param TaskService $taskService
     * @param EventBaseBonusChallengeService $challengeService
     */
    public function __construct(BaseMsisdnService $baseMsisdnService, EventBaseBonusV2CampaignService $campaignService, ProductCoreService $productCoreService, TaskService $taskService, EventBaseBonusChallengeService $challengeService)
    {
        $this->middleware('auth');
        $this->productCoreService = $productCoreService;
        $this->campaignService = $campaignService;
        $this->taskService = $taskService;
        $this->challengeService = $challengeService;
        $this->baseMsisdnService = $baseMsisdnService;
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
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.event-base-bonus.campaigns.v2.create', compact('products', 'challenges', 'baseMsisdnGroups'));
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
        $product_list = $this->productCoreService->findAll();
        $challenges = $this->challengeService->findAll();
        $challengeIds = array_column($campaign['challenges'], 'id');
        $challengesLeft = array_diff(collect($challenges)->pluck('id')->toArray(), $challengeIds);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $products = [];

        foreach ($product_list as $key => $value) {
            $products[] = $value['product_code'];
        }

        return view('admin.event-base-bonus.campaigns.v2.edit', compact('campaign', 'products', 'challenges', 'challengeIds', 'challengesLeft', 'baseMsisdnGroups'));
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
