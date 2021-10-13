<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Services\BaseMsisdnService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventChallengeRequest;
use App\Services\EventBaseBonusCampaignService;
use App\Services\EventBaseBonusChallengeService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Illuminate\Support\Facades\Session;

class EventBaseChallengeController extends Controller
{
    private $eventBaseBonusChallengeService;
    private $campaignService;
    private $taskService;
    private $productCoreService;
    private $baseMsisdnService;

    public function __construct(EventBaseBonusChallengeService $eventBaseBonusChallengeService, BaseMsisdnService $baseMsisdnService, TaskService $taskService, ProductCoreService $productCoreService, EventBaseBonusCampaignService $campaignService)
    {
        $this->middleware('auth');
        $this->eventBaseBonusChallengeService = $eventBaseBonusChallengeService;
        $this->taskService = $taskService;
        $this->campaignService = $campaignService;
        $this->productCoreService = $productCoreService;
        $this->baseMsisdnService = $baseMsisdnService;
    }

    public function index()
    {
        Session::forget('message');
        $challenges = $this->eventBaseBonusChallengeService->findAll();

        if (isset($challenges['message'])) {
            Session::flash('message', $challenges['message']);
            $challenges = [];
        }

        return view('admin.event-base-bonus.challenges.index', compact('challenges'));
    }

    public function create()
    {
        Session::forget('message');
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        if (isset($tasks['message'])) {
            Session::flash('message', $tasks['message']);
            $tasks = [];
        }

        return view('admin.event-base-bonus.challenges.create', compact('products', 'tasks', 'baseMsisdnGroups'));
    }

    public function edit($id)
    {
        Session::forget('message');
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();
        $challenge = $this->eventBaseBonusChallengeService->findOne($id);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        if (isset($tasks['message'])) {
            Session::flash('message', $tasks['message']);
            $tasks = [];
        }

        return view('admin.event-base-bonus.challenges.edit', compact('products', 'tasks', 'challenge', 'baseMsisdnGroups'));
    }

    public function store(StoreEventChallengeRequest $request)
    {
        $response = $this->eventBaseBonusChallengeService->store($request->except('_token'));

        if (isset($response['message'])) {
            Session::flash('message', $response['message']);
        }

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/challenges');
    }

    public function update(StoreEventChallengeRequest $request, $id)
    {
        $response = $this->eventBaseBonusChallengeService->update($request->except('_token', '_method'), $id);

        if (isset($response['message'])) {
            Session::flash('message', $response['message']);
        } else {
            Session::flash('message', 'Campaign Challenge store successful');
        }
        return redirect('/event-base-bonus/challenges');
    }

    public function delete($id)
    {
        $response = $this->eventBaseBonusChallengeService->delete($id);

        Session::flash('message', 'Challenge delete successful');

        return redirect('/event-base-bonus/challenges');
    }
}
