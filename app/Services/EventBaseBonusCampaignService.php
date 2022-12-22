<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EventBaseBonusCampaignService
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
            $url = $this->host . "/api/v1/campaigns";
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
            $url = $this->host . "/api/v1/campaigns/" . $id;
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
                $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_campaign');
            }
            $data['reward_product_code_prepaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;
            $data['base_msisdn_id'] = 1;

            $url = $this->host . "/api/v1/campaigns";

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
                $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_task');
            } else {
                $data['icon_image'] = $data['icon_image_old'];
            }
            unset($data['icon_image_old']);
            $data['reward_product_code_prepaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '',
                strtoupper($data['reward_product_code_postpaid']));
            $data['created_by'] = auth()->user()->email;
            $data['base_msisdn_id'] = 1;

            $url = $this->host . "/api/v1/campaigns/" . $id;

            return $this->apiService->CallAPI("PUT", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id): string
    {
        try {
            $url = $this->host . "/api/v1/campaigns/" . $id;

            return $this->apiService->CallAPI('DELETE', $url, []);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return $exception->getMessage();
        }
    }
}
