<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreEventCampaignRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Services\EventBaseBonusCampaignService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EventBaseCampaignController extends Controller
{
    private $productCoreService;
    private $campaignService;
    private $taskService;

    public function __construct(EventBaseBonusCampaignService $campaignService, ProductCoreService $productCoreService, TaskService $taskService)
    {
        $this->middleware('auth');
        $this->productCoreService = $productCoreService;
        $this->campaignService = $campaignService;
        $this->taskService = $taskService;
    }

    public function index()
    {
        $campaigns = $this->campaignService->findAll();

        return view('admin.event-base-bonus.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $products = $this->productCoreService->findAll();
        $tasks = $this->taskService->findAll();

        return view('admin.event-base-bonus.campaigns.create',compact('products','tasks'));
    }

    public function store(StoreEventCampaignRequest $request)
    {
        $response = $this->campaignService->store($request->except('_token'));

        Session::flash('message', 'Campaign store successful');
        return redirect('/event-base-bonus/campaigns');
    }


    public function edit($id)
    {
        $campaign = $this->campaignService->findOne($id);
        dd($campaign);
        $products = $this->productCoreService->findAll();
        $tasks = $this->taskService->findAll();

        return view('admin.campaign.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->campaignService->update($request->all(), $id);
        //Session::flash('message', $response->getContent());

        return redirect('/event-base-bonus/tasks');
    }

    public function destroy($id)
    {
        $response = $this->campaignService->delete($id);
        //Session::flash('message', $response->getContent());

        return redirect('/event-base-bonus/tasks');
    }
}
