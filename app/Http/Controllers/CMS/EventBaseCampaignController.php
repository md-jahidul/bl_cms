<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreEventCampaignRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Services\EventBaseBonusCampaignService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EventBaseBonusChallengeService;
use Illuminate\Support\Facades\Session;

class EventBaseCampaignController extends Controller
{
    private $productCoreService;
    private $campaignService;
    private $taskService;
    private $challengeService;

    public function __construct(EventBaseBonusCampaignService $campaignService, ProductCoreService $productCoreService, TaskService $taskService, EventBaseBonusChallengeService $challengeService)
    {
        $this->middleware('auth');
        $this->productCoreService = $productCoreService;
        $this->campaignService = $campaignService;
        $this->taskService = $taskService;
        $this->challengeService = $challengeService;
    }

    public function index()
    {
        Session::forget('message');
        $campaigns = $this->campaignService->findAll();

        if (isset($campaigns['message'])) {
            Session::flash('message', $campaigns['message']);
            $campaigns = [];
        }

        return view('admin.event-base-bonus.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        Session::forget('message');
        $products = $this->productCoreService->findAll();
        $challenges = $this->challengeService->findAll();

        if (isset($challenges['message'])) {
            Session::flash('message', $challenges['message']);
            $challenges = [];
        }

        return view('admin.event-base-bonus.campaigns.create', compact('products', 'challenges'));
    }

    public function store(StoreEventCampaignRequest $request)
    {
        $response = $this->campaignService->store($request->except('_token'));

        if (isset($response['message'])) {
            Session::flash('message', $response['message']);
        } else {
            Session::flash('message', 'Campaign store successful');
        }

        return redirect('/event-base-bonus/campaigns');
    }


    public function edit($id)
    {
        Session::forget('message');
        $campaign = $this->campaignService->findOne($id);
        $products = $this->productCoreService->findAll();
        $challenges = $this->challengeService->findAll();
        $challengeIds = array_column($campaign['challenges'], 'id');

        if (isset($campaign['message'])) {
            Session::flash('message', $campaign['message']);
            $campaigns = [];
        }

        return view('admin.event-base-bonus.campaigns.edit', compact('campaign', 'products', 'challenges', 'challengeIds'));
    }

    public function update(StoreEventCampaignRequest $request, $id)
    {
        $response = $this->campaignService->update($request->except('_token', '_method'), $id);

        if (isset($response['message'])) {
            Session::flash('message', $response['message']);
        } else {
            Session::flash('message', 'Updated successful');
        }

        return redirect('/event-base-bonus/campaigns');
    }

    public function destroy($id)
    {
        $response = $this->campaignService->delete($id);
        //Session::flash('message', $response->getContent());

        return redirect('/event-base-bonus/tasks');
    }
}
