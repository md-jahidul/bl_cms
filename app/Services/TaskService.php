<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TaskService
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
        $this->host = env('EVENT_BASE_API_HOST');
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
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @return array|mixed
     */
    public function eventAll()
    {
        try {
            $url = $this->host . "/api/v1/event-list";
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function findOne($id): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-task/" . $id;
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function store($data): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event_bonus_task',
                        $data['icon_image']->getClientOriginalName());
            }
            $data['reward_product_code_prepaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;

            $url = $this->host . "/api/v1/campaign-task";

            return $this->apiService->CallAPI("POST", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $data
     * @param $id
     * @return array
     */
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
            $data['reward_product_code_prepaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;

            $url = $this->host . "/api/v1/campaign-task/" . $id;

            return $this->apiService->CallAPI("PUT", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-task/" . $id;
            $response = $this->apiService->CallAPI("DELETE", $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}
