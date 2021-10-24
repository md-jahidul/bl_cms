<?php

namespace App\Services;

class TaskService extends ApiService
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
            $url      = $this->getHost("/api/v1/campaign-task");
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

    public function eventAll()
    {
        try {
            $url      = $this->getHost("/api/v1/event-list");
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
            $url      = $this->getHost("/api/v1/campaign-task/" . $id);
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

    public function store($data): array
    {
        try {
            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event_bonus_task', $data['icon_image']->getClientOriginalName());
            }
            $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by']                   = auth()->user()->email;

            $url      = $this->getHost("/api/v1/campaign-task");
            $response = $this->CallAPI('POST', $url, []);

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
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event_bonus_task', $data['icon_image']->getClientOriginalName());
            } else {
                $data['icon_image'] = $data['icon_image_old'];
            }
            unset($data['icon_image_old']);
            $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by']                   = auth()->user()->email;

            $url      = $this->getHost("/api/v1/campaign-task/" . $id);
            $response = $this->CallAPI('PUT', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            $response = [
                'data' => [],
                'message' => $exception->getMessage()
            ];

            return $response;
        }
    }

    public function delete($id): array
    {
        $client   = new ApiService();
        $url      = env('EVENT_BASE_API_HOST') . "/api/v1/campaign-task/" . $id;

        return $client->CallAPI("DELETE", $url, []);
    }
}
