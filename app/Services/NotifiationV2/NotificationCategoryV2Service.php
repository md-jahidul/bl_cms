<?php

namespace App\Services\NotifiationV2;

use App\Repositories\NotificationCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use \GuzzleHttp\Client as Http;

class NotificationCategoryV2Service
{
    use CrudTrait;

    private $Http;

    public function __construct()
    {
        $this->Http = new Http();
    }
    public function findAll()
    {
        $res = $this->Http->request('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory');
        $strBody = $res->getBody();
        return json_decode($strBody, true);
        
    }

    public function storeNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
        $body = [
            'name' => $data['name'],
            'slug' => $data['slug']
        ];

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/store', ['json' => $body]);

        return new Response("Notification Category has been successfully created");
    }

    public function findOneById($id)
    {
        $body = [
            'id' => $id,
        ];
        $res = $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/show', ['json' => $body]);
        $strBody = $res->getBody();
        return json_decode($strBody, true);
    }

    public function updateNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        
        $body = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'id'   => $data['id']
        ];

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/update', ['json' => $body]);

        return Response('Notification Category has been successfully updated');
    }

    public function deleteNotificationCategory($id)
    {
        $body = [
            'id' => $id,
        ];

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/delete', ['json' => $body]);

        return Response('Notification Category has been successfully deleted');
    }
}
