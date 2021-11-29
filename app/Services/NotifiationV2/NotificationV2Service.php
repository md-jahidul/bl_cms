<?php

namespace App\Services\NotifiationV2;

use \GuzzleHttp\Client as Http;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Response;
class NotificationV2Service
{

    use CrudTrait;

    private $Http;

    public function __construct()
    {
        $this->Http = new Http();
    }

    public function findAll()
    {
        $res = $this->Http->request('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft');
        $strBody = $res->getBody();

        return json_decode($strBody, true);
    }

    public function storeNotificationDraft($data)
    {
        $data['starts_at'] = $data['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/store', ['json' => $data]);

        return ("Notification Draft has been successfully created");
    }

    public function findOneById($id)
    {
        $body = [
            'id' => $id,
        ];
        $res = $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/show', ['json' => $body]);
        $strBody = $res->getBody();
        return json_decode($strBody, true);
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

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationDraft/update', ['json' => $body]);

        return ("Notification Draft has been successfully Updated");
    }

    public function getTargetWiseNotificationReport()
    {
        $res = $this->Http->request('get', env('NOTIFICATION_MODULE_BASE_URL') . 'notifications');
        $strBody = $res->getBody();

        return json_decode($strBody, true);
    }

    public function getNotificationTargetwiseReport($id)
    {
        $body = [
            'notificationId' => $id
        ];

        $res = $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'usersNotification', ['json' => $body]);
        $strBody = $res->getBody();
        return json_decode($strBody, true);
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

        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'notificationSchedule/store', ['json' => $data]);

        return ("Notification Draft has been successfully Updated");
    }
}
