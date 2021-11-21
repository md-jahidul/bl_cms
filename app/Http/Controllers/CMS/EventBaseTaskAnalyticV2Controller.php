<?php

namespace App\Http\Controllers\CMS;

use App\Enums\EventBasedAnalyticTypes;
use App\Http\Requests\TaskAnalyticRequest;
use App\Http\Controllers\Controller;
use App\Services\TaskAnalyticServiceV2;

class EventBaseTaskAnalyticV2Controller extends Controller
{

    public function __construct(TaskAnalyticServiceV2 $taskAnalyticService)
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

    public function viewCampaignChallenges($campaign)
    {
        $params = [
            'analytics_type' => EventBasedAnalyticTypes::CHALLENGE,
            'campaign_id' => $campaign
        ];

        $challengeAnalytics = $this->taskAnalyticService->getAnalytics($params);

        return view('admin.event-base-bonus.analytic.view-campaign-challenges', compact('challengeAnalytics'));
    }

    public function viewCampaignChallengeTasks($campaign, $challenge)
    {
        $params = [
            'analytics_type' => EventBasedAnalyticTypes::TASK,
            'campaign_id' => $campaign,
            'campaign_challenge_id' => $challenge,
        ];

        $challengeTasksAnalytics = $this->taskAnalyticService->getAnalytics($params);

        return view('admin.event-base-bonus.analytic.view-campaign-challenge-tasks', compact('challengeTasksAnalytics'));
    }

    public function viewCampaignChallengeTaskMsisdnList($campaign, $challenge, $task, $msisdn = null)
    {
        $params = [
            'analytics_type' => EventBasedAnalyticTypes::MSISDN,
            'campaign_id' => $campaign,
            'campaign_challenge_id' => $challenge,
            'campaign_task_id' => $task
        ];

        if (isset($msisdn)) {
            $params['msisdn'] = 1;
            $params['status'] = $msisdn;
        }

        $challengeTaskMsisdnList = $this->taskAnalyticService->getAnalytics($params);

        if (isset($msisdn) && $params['status']) {
            return view('admin.event-base-bonus.analytic.view-campaign-msidn-list', compact('challengeTaskMsisdnList'));
        }

        return view('admin.event-base-bonus.analytic.view-campaign-challenge-tasks-msisdn', compact('challengeTaskMsisdnList'));
    }
}
