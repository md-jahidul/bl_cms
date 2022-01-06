<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskAnalyticServiceV2
{
    /**
     * @var ApiService
     */
    private $apiService;
    /**
     * @var mixed
     */
    private $host;

    /**
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->host = env('EVENT_BASE_API_HOST_V2');
    }

    public function getAnalytics($data): array
    {
        try {
            $url = $this->host . "/api/v1/campaign/analytics";
            $response = $this->apiService->CallAPI('POST', $url, $data);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
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
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}
