<?php

namespace App\Http\Controllers\CMS;

use App\Services\TaskAnalyticService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventBaseTaskAnalyticController extends Controller
{
    private $taskService;
    private $productCoreService;

    public function __construct(TaskAnalyticService $taskAnalyticService)
    {
        $this->middleware('auth');
        $this->taskAnalyticService        = $taskAnalyticService;
    }

    public function index()
    {
        return view('admin.event-base-bonus.analytic.analytic');
    }

    public function analytics(Request $request)
    {
        // event base analytics report generate
        return $this->taskAnalyticService->getAnalytics($request->all());
    }

    public function viewDetails($campaign, $task)
    {
        $taskAnalyticUserDetails = $this->analyticsUserDetails($campaign, $task);

        return view('admin.event-base-bonus.analytic.view-detail', compact('taskAnalyticUserDetails'));
    }

    private function analyticsUserDetails($campaign, $task)
    {
        $params = [
            'event_based_campaign_id' => $campaign,
            'campaign_task_id' => $task
        ];

        return $this->taskAnalyticService->filterAnalytic($params);
    }
}
