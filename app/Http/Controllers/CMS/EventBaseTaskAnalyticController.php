<?php

namespace App\Http\Controllers\CMS;

use App\Services\TaskAnalyticService;
use App\Http\Requests\TaskAnalyticRequest;
use App\Http\Requests\TaskAnalyticUserDetailRequest;
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

    public function analytics(TaskAnalyticRequest $request)
    {
        return $this->taskAnalyticService->getAnalytics($request->all());
    }

    public function viewDetails($campaign, $task)
    {
        return view('admin.event-base-bonus.analytic.view-detail');
    }

    private function analyticsUserDetails(TaskAnalyticUserDetailRequest $request)
    {
        $params = $request->all();
        unset($params['_token']);

        return $this->taskAnalyticService->filterAnalytic($params);
    }
}
