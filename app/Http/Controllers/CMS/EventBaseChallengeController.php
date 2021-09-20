<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
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

    public function __construct(EventBaseBonusChallengeService $eventBaseBonusChallengeService, TaskService $taskService, ProductCoreService $productCoreService, EventBaseBonusCampaignService $campaignService)
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

        return view('admin.event-base-bonus.challenges.index', compact('challenges'));
    }

    public function create()
    {
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();

        return view('admin.event-base-bonus.challenges.create', compact('products', 'tasks'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $response = $this->eventBaseBonusChallengeService->store($request->except('_token'));

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/challenges');
    }
}
