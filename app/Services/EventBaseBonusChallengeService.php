<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;

class EventBaseBonusChallengeService
{
    public function findAll(): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/challenges";
        $response = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function findOne($id): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/challenges/" . $id;
        $response  = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function store($data): array
    {
        dd($data);
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_challenge');
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/challenges";

        return $client->CallAPI("POST", $url, $data);
    }

    public function update($data, $id): array
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_challenge');
        } else {
            $data['icon_image'] = $data['icon_image_old'];
        }
        unset($data['icon_image_old']);
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;
        $data['base_msisdn_id']               = 1;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/challenges/" . $id;

        return $client->CallAPI("PUT", $url, $data);
    }

    public function delete($id): string
    {
        dd($id);
    }
}
