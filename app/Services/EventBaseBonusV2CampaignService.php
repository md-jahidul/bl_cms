<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;

class EventBaseBonusV2CampaignService
{
    public function findAll(): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaigns";
        $response = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function findOne($id): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaigns/" . $id;
        $response  = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function store($data): array
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event-base-bonus', $data['icon_image']->getClientOriginalName());
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;
        $data['base_msisdn_id']               = 1;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaigns";

        return $client->CallAPI("POST", $url, $data);
    }

    public function update($data, $id): array
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event-base-bonus', $data['icon_image']->getClientOriginalName());
        } else {
            $data['icon_image'] = $data['icon_image_old'];
        }
        unset($data['icon_image_old']);
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;
        $data['base_msisdn_id']               = 1;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaigns/" . $id;

        return $client->CallAPI("PUT", $url, $data);
    }

    public function delete($id)
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST_V2') . "/api/v1/campaigns/" . $id;

        return $client->CallAPI("DELETE", $url, []);
    }
}
