<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventChallengeRequest;
use App\Services\EventBaseBonusChallengeService;
use App\Services\EventBaseBonusV2CampaignService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Session;

class EventBaseChallengeV2Controller extends Controller
{
    private $eventBaseBonusChallengeService;
    private $campaignService;
    private $taskService;
    private $productCoreService;

    public function __construct(EventBaseBonusChallengeService $eventBaseBonusChallengeService, TaskService $taskService, ProductCoreService $productCoreService, EventBaseBonusV2CampaignService $campaignService)
    {
        $this->middleware('auth');
        $this->eventBaseBonusChallengeService = $eventBaseBonusChallengeService;
        $this->taskService = $taskService;
        $this->campaignService = $campaignService;
        $this->productCoreService = $productCoreService;
    }

    public function index()
    {
        $challenges = $this->eventBaseBonusChallengeService->findAll();

        return view('admin.event-base-bonus.challenges.v2.index', compact('challenges'));
    }

    public function create()
    {
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();

        return view('admin.event-base-bonus.challenges.v2.create', compact('products', 'tasks'));
    }

    public function edit($id)
    {
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();
        $challenge = $this->eventBaseBonusChallengeService->findOne($id);

        return view('admin.event-base-bonus.challenges.v2.edit', compact('products', 'tasks', 'challenge'));
    }

    public function store(StoreEventChallengeRequest $request)
    {
        $response = $this->eventBaseBonusChallengeService->store($request->except('_token'));

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/v2/challenges');
    }

    public function update(StoreEventChallengeRequest $request, $id)
    {
        $response = $this->eventBaseBonusChallengeService->update($request->except('_token', '_method'), $id);

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/v2/challenges');
    }

    public function delete($id)
    {
        $response = $this->taskService->delete($id);

        Session::flash('message', 'Task delete successful');

        return redirect('/event-base-bonus/v2/tasks');
    }
}
