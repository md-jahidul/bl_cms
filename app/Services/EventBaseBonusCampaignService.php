<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;

class EventBaseBonusCampaignService
{
    public function findAll() : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaigns";
        $request  = $client->get($url);
        $response = json_decode($request->getBody(), true);

        return $response['data'];
    }

    public function eventAll()
    {
        return [
            [
                'title_en' => 'title 1',
                'title_bn' => 'title 1',

            ],
            [
                'title_en' => 'title 2',
                'title_bn' => 'title 2',
            ],
        ];
    }

    public function findOne($id) : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaigns/" . $id;
        $request  = $client->get($url);
        $response = json_decode($request->getBody(), true);

        return $response['data'];
    }

    public function store($data) : string
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_campaign');
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;
        $data['base_msisdn_id']               = 1;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaigns";
        $request  = $client->post($url, $data);
        $response = $request->getStatusCode();

        return $response;

    }

    public function update($data, $id) : string
    {
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

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaigns/" . $id;
        $request  = $client->put($url, $data);
        $response = $request->getStatusCode();

        return $response;
    }

    public function delete($id) : string
    {
        dd($id);
    }
}
