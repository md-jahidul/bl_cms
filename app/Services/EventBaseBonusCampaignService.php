<?php

namespace App\Services;

class EventBaseBonusCampaignService
{
    public function findAll() : array
    {
        $client   = new \GuzzleHttp\Client();
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
        return [
            'title_en'          => 'title 2',
            'title_bn'          => 'title 2',
            'description_en'    => 'description 2',
            'description_bn'    => 'description 2',
            'btn_text_en'       => 'btn text 2',
            'btn_text_bn'       => 'btn text 2',
            'recurrence_number' => '12',
            'reword_prepaid'    => 'reword pre 2',
            'reword_postpaid'   => 'reword post 2',
            'reward_text'       => 'reward_text 2',
            'event'             => 'event 2',
            'status'            => 0,
        ];
    }

    public function store($data) : string
    {
        dd($data);
    }

    public function update($data, $id) : string
    {
        dd($data);
    }

    public function delete($id) : string
    {
        dd($id);
    }
}
