<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskAnalyticService
{
    /**
     * @var $apiService
     */
    private $apiService;
    /**
     * @var $host
     */
    private $host;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = new ApiService();
        $this->host = env('EVENT_BASE_API_HOST');
    }

    public function getAnalytics($data): array
    {
        try {
            Session::forget('message');
            $url = $this->host . "/api/v1/campaign-task-user/analytics";
            $response = $this->apiService->CallAPI('POST', $url, $data);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function filterAnalytic($data): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-task-user/all";
            $response = $this->apiService->CallAPI('POST', $url, $data);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}