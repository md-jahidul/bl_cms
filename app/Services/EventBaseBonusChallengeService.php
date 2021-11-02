<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Carbon\Carbon;

class EventBaseBonusChallengeService extends ApiService
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
            $url      = $this->getHost("/api/v1/campaign-challenge");
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
            $url      = $this->getHost("/api/v1/campaign-challenge/" . $id);
            $response = $this->CallAPI('GET', $url, []);

            $challenge = $response['data'];

            $taskIds = [];

            if ($challenge['task_pick_type']) {
                foreach ($challenge['event_based_challenge_tasks'] as $task) {
                    $taskIds[$task['day_no']][] = $task['campaign_task_id'];
                }
            } else {
                foreach ($challenge['event_based_challenge_tasks'] as $task) {
                    $taskIds[0][] = $task['campaign_task_id'];
                }
            }

            $challenge['taskIds'] = json_encode($taskIds);
            $response['data'] = $challenge;

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
            $challenge_data = $data;

            $challenge_data['tasks'] = new \stdClass;

            if ($data['task_pick_type']) {
                foreach ($data['day_tasks'] as $key => $task) {
                    $challenge_data['tasks']->{$key + 1} = $task;
                }
            } else {
                $challenge_data['tasks']->{0} = [];
                foreach ($data['random_tasks'] as $key => $task) {
                    array_push($challenge_data['tasks']->{0}, $task[0]);
                }
            }

            $data = $challenge_data;

            unset($data['random_tasks']);
            unset($data['day_tasks']);

            if (!empty($data['icon_image'])) {
                $data['icon_image'] = 'storage/' . $data['icon_image']->storeAs('event-base-bonus', $data['icon_image']->getClientOriginalName());
            }
            $data['reward_product_code_prepaid']  = str_replace(' ', '', strtoupper($data['reward_product_code_prepaid']));
            $data['reward_product_code_postpaid'] = str_replace(' ', '', strtoupper($data['reward_product_code_postpaid']));
            $data['created_by']                   = auth()->user()->email;

            $url      = $this->getHost("/api/v1/campaign-challenge");
            $response = $this->CallAPI('POST', $url, $data);

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
            $challenge_data = $data;

            $challenge_data['tasks'] = new \stdClass;

            if ($data['task_pick_type']) {
                foreach ($data['day_tasks'] as $key => $task) {
                    $challenge_data['tasks']->{$key + 1} = $task;
                }
            } else {
                $challenge_data['tasks']->{0} = [];
                foreach ($data['random_tasks'] as $key => $task) {
                    array_push($challenge_data['tasks']->{0}, $task[0]);
                }
            }

            $data = $challenge_data;

            unset($data['random_tasks']);
            unset($data['day_tasks']);

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

            $url      = $this->getHost("/api/v1/campaign-challenge/" . $id);
            $response = $this->CallAPI('PUT', $url, $data);

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
        $client   = new ApiService();
        $url      = $this->getHost("/api/v1/campaign-challenge/" . $id);

        return $client->CallAPI("DELETE", $url, []);
    }
}
