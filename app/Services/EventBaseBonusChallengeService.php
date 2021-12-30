<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EventBaseBonusChallengeService
{
    /**
     * @var ApiService
     */
    private $apiService;
    /**
     * @var mixed
     */
    private $host;

    /**
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->host = env('EVENT_BASE_API_HOST_V2');
    }

    public function findAll(): array
    {
        try {
            Session::forget('message');
            $url = $this->host . "/api/v1/campaign-challenge";
            $response = $this->apiService->CallAPI('GET', $url, []);

            return $response['data'];
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function findOne($id): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-challenge/" . $id;
            $response = $this->apiService->CallAPI('GET', $url, []);

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
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
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

            $url = $this->host . "/api/v1/campaign-challenge";

            return $this->apiService->CallAPI("POST", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
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

            $url = $this->host . "/api/v1/campaign-challenge/" . $id;

            return $this->apiService->CallAPI("PUT", $url, $data);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }

    public function delete($id): array
    {
        try {
            $url = $this->host . "/api/v1/campaign-challenge/" . $id;

            return $this->apiService->CallAPI("DELETE", $url, []);
        } catch (\Exception $exception) {
            Log::channel('event-based-bonus-v2')->error($exception->getMessage());
            Session::flash("message", $exception->getMessage());
            return [];
        }
    }
}
