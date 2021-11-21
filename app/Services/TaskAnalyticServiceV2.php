<?php

namespace App\Services;

class TaskAnalyticServiceV2
{
    private $client;

    public function __construct()
    {
        $this->client = new ApiService();
    }

    public function getAnalytics($data): array
    {
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaign/analytics";
        $response  = $this->client->CallAPI('POST', $url, $data);

        return $response['data'];
    }

    public function filterAnalytic($data): array
    {
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaign-task-user/all";
        $response  = $this->client->CallAPI('POST', $url, $data);

        return $response['data'];
    }
}
