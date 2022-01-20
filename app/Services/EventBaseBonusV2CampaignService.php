<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EventBaseBonusV2CampaignService
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
            $url = $this->host . "/api/v1/campaigns";
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
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
            $url = $this->host . "/api/v1/campaigns/" . $id;
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
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
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event-base-bonus', $data['icon_image']->getClientOriginalName());
            }
            $data['created_by']                   = auth()->user()->email;

            $url = $this->host . "/api/v1/campaigns";

            return $this->apiService->CallAPI("POST", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
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
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event-base-bonus', $data['icon_image']->getClientOriginalName());
            } else {
                $data['icon_image'] = $data['icon_image_old'];
            }
            unset($data['icon_image_old']);
            $data['created_by']                   = auth()->user()->email;

            $url = $this->host . "/api/v1/campaigns/" . $id;

            return $this->apiService->CallAPI("PUT", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $id
     * @return array|mixed|string
     */
    public function delete($id)
    {
        try {
            $url = $this->host . "/api/v1/campaigns/" . $id;

            return $this->apiService->CallAPI("DELETE", $url, []);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}
