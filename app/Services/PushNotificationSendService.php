<?php

namespace App\Services;

use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\File;

class PushNotificationSendService
{

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @var $NotificationDraftRepository
     */
    protected $notificationDraftRepository;


    /**
     * PushNotificationSendService constructor.
     * @param NotificationDraftRepository $notificationDraftRepository
     * @param NotificationRepository $notificationRepository
     */
    public function __construct(NotificationDraftRepository $notificationDraftRepository,
                                NotificationRepository $notificationRepository)
    {
        $this->notificationDraftRepository = $notificationDraftRepository;
        $this->notificationRepository = $notificationRepository;
    }


    /**
     * @param array $data
     * @param array $user_phone
     * @param $notificationInfo
     * @return array
     */
    public function getNotificationArray( array $data, array $user_phone, $notificationInfo): array
    {
        $url = "test.com";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'URL') {
            $url = "$notificationInfo->external_url";
        }

        $product_code = "0000";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'PURCHASE') {
            $product_code = "$notificationInfo->external_url";
        }

        $category_id = !empty($data['category_id'])?$data['category_id']:1;


        if (isset($data['image_url'])) {
            $image_url = env('NOTIFICATION_HOST') . "/" . $data['image_url'] ?? null;
        } else{
            $image_url = null;
        }

        return [
            'title' => $data['title'],
            'body' => $data['message'],
            'category_slug' => $data['category_slug'],
            'category_name' => $data['category_name'],
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $user_phone,
            "is_interactive" => "NO",
            "mutable_content" => true,
            "data" => [
                "cid" => "$category_id",
                "url" => "$url",
                "image_url" => $image_url,
                "component" => "offer",
                'product_code' => "$product_code",
                'navigation_action' => "$notificationInfo->navigate_action"
            ],
        ];
    }

}
