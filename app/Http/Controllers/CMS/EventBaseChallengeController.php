<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventChallengeRequest;
use App\Services\EventBaseBonusCampaignService;
use App\Services\EventBaseBonusChallengeService;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Carbon\Carbon;
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

    public function edit($id)
    {
        $tasks = $this->taskService->findAll();
        $products = $this->productCoreService->findAll();
        $challenge = $this->eventBaseBonusChallengeService->findOne($id);
        $taskIds = [];

        $challenge['start_date'] = Carbon::createFromTimestamp($challenge['start_date'])->toDateTimeString();;
        $challenge['end_date'] = Carbon::createFromTimestamp($challenge['end_date'])->toDateTimeString();;

        if ($challenge['task_pick_type']) {
            foreach ($challenge['event_based_challenge_tasks'] as $task) {
                $taskIds[$task['day_no']][] = $task['campaign_task_id'];
            }

            $taskIds = json_encode($taskIds);
        } else {
            $taskIds = array_column($challenge['event_based_challenge_tasks'], 'campaign_task_id');
        }

        return view('admin.event-base-bonus.challenges.edit', compact('products', 'tasks', 'challenge', 'taskIds'));
    }

    public function store(StoreEventChallengeRequest $request)
    {
        $response = $this->eventBaseBonusChallengeService->store($request->except('_token'));

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/challenges');
    }

    public function update(StoreEventChallengeRequest $request, $id)
    {
        $response = $this->eventBaseBonusChallengeService->update($request->except('_token', '_method'), $id);

        Session::flash('message', 'Campaign Challenge store successful');
        return redirect('/event-base-bonus/challenges');
    }
}
