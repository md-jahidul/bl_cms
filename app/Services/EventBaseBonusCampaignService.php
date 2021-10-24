<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;

class EventBaseBonusCampaignService extends ApiService
{
    /**
     * Prepare campaign host from env file
     *
     * @return string
     */
    public static function getHost($withurl = ''): string
    {
        return env('EVENT_BASE_API_HOST') . $withurl;
    }

    public function findAll(): array
    {
        try {
            $url      = $this->getHost("/api/v1/campaigns");
            $response = $this->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            $response = [
                'data' => [],
                'message' => $exception->getMessage()
            ];

            return $response;
        }
    }

    public function findOne($id): array
    {
        try {
            $url      = $this->getHost("/api/v1/campaigns/" . $id);
            $response  = $this->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            $response = [
                'data' => [],
                'message' => $exception->getMessage()
            ];

            return $response;
        }
    }

    public function store($data): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_campaign');
            }
            $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by']                   = auth()->user()->email;
            $data['base_msisdn_id']               = 1;

            $url      = $this->getHost("/api/v1/campaigns");
            $response  = $this->CallAPI('POST', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            $response = [
                'data' => [],
                'message' => $exception->getMessage()
            ];

            return $response;
        }
    }

    public function update($data, $id): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_task');
            } else {
                $data['icon_image'] = $data['icon_image_old'];
            }
            unset($data['icon_image_old']);
            $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by']                   = auth()->user()->email;
            $data['base_msisdn_id']               = 1;

            $url      = $this->getHost("/api/v1/campaigns/" . $id);
            $response  = $this->CallAPI('PUT', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            $response = [
                'data' => [],
                'message' => $exception->getMessage()
            ];

            return $response;
        }
    }

    public function delete($id): string
    {
        dd($id);
    }
}
