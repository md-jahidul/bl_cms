<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskServiceV2
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

    /**
     * @return array
     */
    public function findAll(): array
    {
        try {
            Session::forget('message');
            $url = $this->host . "/api/v1/campaign-task";
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function eventAll()
    {
        try {
            $url = $this->host . "/api/v1/event-list";
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function findOne($id): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-task/" . $id;
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function store($data): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event_bonus_task',
                        $data['icon_image']->getClientOriginalName());
            }
            $data['reward_product_code_prepaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;

            $url = $this->host . "/api/v1/campaign-task";
            $response = $this->apiService->CallAPI("POST", $url, $data);

            return $this->apiService->CallAPI('GET', $url, []);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function update($data, $id): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event_bonus_task',
                        $data['icon_image']->getClientOriginalName());
            } else {
                $data['icon_image'] = $data['icon_image_old'];
            }
            unset($data['icon_image_old']);
            $data['reward_product_code_prepaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;

            $url = $this->host . "/api/v1/campaign-task/" . $id;
            $response = $this->apiService->CallAPI("PUT", $url, $data);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function delete($id)
    {
        try {
            $url = $this->host . "/api/v1/campaign-task/" . $id;

            return $this->apiService->CallAPI("DELETE", $url, []);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}
