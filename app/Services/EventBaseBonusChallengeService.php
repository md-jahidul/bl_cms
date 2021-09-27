<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;

class EventBaseBonusChallengeService
{
    public function findAll(): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-challenge";
        $response = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function findOne($id): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-challenge/" . $id;
        $response  = $client->CallAPI('GET', $url, []);

        return $response['data'];
    }

    public function store($data): array
    {
        $challenge_data = $data;

        $challenge_data['tasks'] = new \stdClass;

        if ($data['task_pick_type']) {
            foreach ($data['tasks'] as $key => $task) {
                $challenge_data['tasks']->{$key + 1} = $task;
            }
        } else {
            $challenge_data['tasks']->{0} = $data['tasks'][0];
        }

        $data = $challenge_data;

        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_challenge');
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-challenge";

        return $client->CallAPI("POST", $url, $data);
    }

    public function update($data, $id): array
    {
        $challenge_data = $data;

        $challenge_data['tasks'] = new \stdClass;

        if ($data['task_pick_type']) {
            foreach ($data['day_tasks'] as $key => $task) {
                $challenge_data['tasks']->{$key + 1} = $task;
            }
        } else {
            $challenge_data['tasks']->{0} = $data['random_tasks'][0];
        }

        $data = $challenge_data;

        unset($data['random_tasks']);
        unset($data['day_tasks']);

        //dd($data);

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
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-challenge/" . $id;

        return $client->CallAPI("PUT", $url, $data);
    }

    public function delete($id): string
    {
        dd($id);
    }
}
