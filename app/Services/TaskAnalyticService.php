<?php

namespace App\Services;

class TaskAnalyticService
{
    private $client;

    public function __construct()
    {
        $this->client = new ApiService();
    }

    public function getAnalytics($data): array
    {
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task-user/analytics";
        $response  = $this->client->CallAPI('POST', $url, $data);

        return $response['data'];
    }

    public function filterAnalytic($data): array
    {
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task-user/all";
        $response  = $this->client->CallAPI('POST', $url, $data);

        return $response['data'];
    }
}