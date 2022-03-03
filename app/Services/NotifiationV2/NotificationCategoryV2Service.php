<?php

namespace App\Services\NotifiationV2;

use App\Repositories\NotificationCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class NotificationCategoryV2Service
{
    use CrudTrait;

    /* GuzzleHttp*/
    
    // private $Http;

    // public function __construct()
    // {
    //     $this->Http = new Http();
    // }
    // public function findAll()
    // {
    //     $res = $this->Http->request('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory');
    //     $strBody = $res->getBody();
    //     return json_decode($strBody, true);
        
    // }

    // public function storeNotificationCategory($data)
    // {
    //     $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
    //     $body = [
    //         'name' => $data['name'],
    //         'slug' => $data['slug']
    //     ];

    //     $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/store', ['json' => $body]);

    //     return new Response("Notification Category has been successfully created");
    // }

    // public function findOneById($id)
    // {
    //     $body = [
    //         'id' => $id,
    //     ];
    //     $res = $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/show', ['json' => $body]);
    //     $strBody = $res->getBody();
    //     return json_decode($strBody, true);
    // }

    // public function updateNotificationCategory($data)
    // {
    //     $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
    //     $body = [
    //         'name' => $data['name'],
    //         'slug' => $data['slug'],
    //         'id'   => $data['id']
    //     ];

    //     $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/update', ['json' => $body]);

    //     return Response('Notification Category has been successfully updated');
    // }

    // public function deleteNotificationCategory($id)
    // {
    //     $body = [
    //         'id' => $id,
    //     ];

    //     $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/delete', ['json' => $body]);

    //     return Response('Notification Category has been successfully deleted');
    // }


    public function findAll()
    {
        [$get_data, $info] = $this->callAPI('GET', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory');

        return json_decode($get_data, true);
    }

    public function storeNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
        $body = [
            'name' => $data['name'],
            'slug' => $data['slug']
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/store', $body);

        return new Response("Notification Category has been successfully created");
    }

    public function findOneById($id)
    {
        $body = [
            'id' => $id,
        ];
        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/show', $body);

        return json_decode($get_data, true);
    }

    public function updateNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
        $body = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'id'   => $data['id']
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/update', $body);

        return Response('Notification Category has been successfully updated');
    }

    public function deleteNotificationCategory($id)
    {
        $body = [
            'id' => $id,
        ];

        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/delete', $body);

        return Response('Notification Category has been successfully deleted');
    }

    public function syncNotificationCategory(){

        $listNotificationsCategory = DB::table('notifications_category')
                                ->pluck('slug')
                                ->toArray();
                                
        [$get_data, $info] = $this->callAPI('GET', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/listSlug');

        $data = json_decode($get_data, true);
        $listNotificationsCategoryFromMongoDB = $data['data'];

        $uniqueNotificationCategory = array_diff($listNotificationsCategory, $listNotificationsCategoryFromMongoDB);

        $notificationsCategoryList = DB::table('notifications_category')->when(is_array($uniqueNotificationCategory), 
            function ($q) use ($uniqueNotificationCategory) {
                return $q->whereIn('slug', $uniqueNotificationCategory);
        })->select('name', 'slug', 'created_at', 'updated_at')->get();

        if($notificationsCategoryList->isEmpty()) {
            return 'Payload Empty';
        }

        $requestData = [
            'categories' => $notificationsCategoryList,
        ];
        
        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/storeBulk', $requestData);

        return $get_data;
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
