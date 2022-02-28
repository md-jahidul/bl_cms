<?php

namespace App\Services\NotifiationV2;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Response;
class NotificationV2Service
{
    use CrudTrait;

    public function findAll()
    {
        [$get_data, $info] = $this->callAPI('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft');

        return json_decode($get_data, true);
    }

    public function storeNotificationDraft($data)
    {
        $data['starts_at'] = $data['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/store', $data);

        return ("Notification Draft has been successfully created");
    }

    public function findOneById($id)
    {
        $body = [
            'id' => $id,
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/show', $body);
      
        return json_decode($get_data, true);
    }

    public function updateNotification($request)
    {
        $request['starts_at'] = $request['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');
    
        $body = [
            "id"                        => $request['id'],
            "category_id"               => $request['category_id'],
            "title"                     => $request['title'],
            "body"                      => $request['body'],
            "cta_name"                  => isset($request['cta_name']) ? $request['cta_name'] : null,
            "cta_action"                => isset($request['cta_action']) ? $request['cta_action'] : null,
            "notification_type"         => isset($request['notification_type']) ? $request['notification_type'] : null,
            "device_type"               => $request['device_type'],
            "customer_type"             => $request['customer_type'],
            "navigate_action"           => $request['navigate_action'],
            "external_url"              => isset($request['external_url']) ? $request['external_url'] : null,
            "image"                     => isset($request['image']) ? $request['image'] : null,
            "starts_at"                 => $request['starts_at'],
            "expires_at"                => $request['expires_at']
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/update', $body);

        return ("Notification Draft has been successfully Updated");
    }

    public function getTargetWiseNotificationReport()
    {
        [$get_data, $info] = $this->callAPI('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notifications');

        return json_decode($get_data, true);
    }

    public function getNotificationTargetwiseReport($id)
    {
        $body = [
            'notificationId' => $id
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'usersNotification', $body);
        
        return json_decode($get_data, true);
    }

    public function createNotificationSchedule($request, $file_name, $time)
    {
        $data = [
            "notification_draft_id"         => $request['notification_id'],
            "notification_category_id"      => $request['category_id'],
            "title"                         => $request['title'],
            "message"                       => $request['message'],
            "file_name"                     => $file_name,
            "start"                         => $time[0],
            "end"                           => $time[1],
            "status"                        => 'active'
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationSchedule/store', $data);

        return ("Notification Draft has been successfully Created");
    }

    private function callAPI($method, $url, $data=[], $header=[], $auth=false)
    {
        $curl = curl_init();

        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if (!empty($data))
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if (!empty($data))
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if (!empty($data))
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        // Set URL
        curl_setopt($curl, CURLOPT_URL, $url);
        // Set Return 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // Set SSL Disable
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if(!empty($header)) {
            // Set HEADER
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
             ));
        }
        
        if($auth) {
            // Set Auth
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }
        
        try {
            // EXECUTE:
            $result = curl_exec($curl);     
        } catch(\Exception $e) {
            $errorJson = json_encode([
                "status" => "FAIL",
                "status_code" => 422,
                "error" => [
                    "message" => "Notification Module Connection Error"
                ]
            ]);

            http_response_code(422);
            exit($errorJson);
        }

        // INFO:
        $info = curl_getinfo($curl);

        if(!$result) {
            $errorJson = json_encode([
                "status" => "FAIL",
                "status_code" => 422,
                "error" => [
                    "message" => "Notification Module Connection Error"
                ]
            ]);

            http_response_code(422);
            exit($errorJson);
        }

        curl_close($curl);

        return [$result, $info];
    }
}
