<?php

namespace App\Services;

class TaskService
{
    public function findAll() : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task";
        $request  = $client->get($url);
        $response = json_decode($request->getBody(), true);

        return $response['data'];
    }

    public function eventAll()
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/event-list";
        $request  = $client->get($url);
        $response = json_decode($request->getBody(), true);

        return $response['data'];
    }

    public function findOne($id) : array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;
        $request  = $client->get($url);
        $response = json_decode($request->getBody(), true);

        return $response['data'];
    }

    public function store($data) : string
    {
        if (!empty($data['icon_image'])) {
            $data['icon_image'] = 'storage/' . $data['icon_image']->store('event_bonus_task');
        }
        $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
        $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
        $data['created_by']                   = auth()->user()->email;

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task";
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

        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;
        $request  = $client->put($url, $data);
        $response = $request->getStatusCode();

        return $response;
    }

    public function delete($id) : string
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;
        $request  = $client->delete($url);
        $response = $request->getStatusCode();

        return $response;
    }
}
