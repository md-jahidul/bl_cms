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

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationCategory/store',['json' => $body]);

        return new Response("Notification Category has been successfully created");
    }

    public function updateNotificationCategory($data, $id)
    {
        $notificationCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        $notificationCategory->update($data);
        return Response('Notification Category has been successfully updated');
    }

    public function deleteNotificationCategory($id)
    {
        $notificationCategory = $this->findOne($id);
        $notificationCategory->delete();
        return Response('Notification Category has been successfully deleted');
    }
}
