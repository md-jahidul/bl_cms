<?php

namespace App\Services;

class TaskService
{
    public function findAll() : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task";
        $response  = $client->CallAPI('GET',$url,[]);

        return $response['data'];
    }

    public function eventAll()
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/event-list";
        $response  = $client->CallAPI('GET',$url,[]);

        return $response['data'];
    }

    public function findOne($id) : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;
        $response  = $client->CallAPI('GET',$url,[]);

        return $response['data'];
    }

    public function store($data) : array
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_task');
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task";
        return $client->CallAPI("POST",$url, $data);
    }

    public function update($data, $id) : array
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

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;

        return $client->CallAPI("PUT",$url, $data);
    }

    public function delete($id) : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;

        return $client->CallAPI("DELETE",$url, []);
    }
}
