<?php

namespace App\Services;

use App\Models\NotificationSchedule;
use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PushNotificationSendService
{

    use FileTrait;

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
    public function __construct(
        NotificationDraftRepository $notificationDraftRepository,
        NotificationRepository $notificationRepository
    ) {
        $this->notificationDraftRepository = $notificationDraftRepository;
        $this->notificationRepository = $notificationRepository;
    }


    /**
     * @param array $data
     * @param array $user_phone
     * @param $notificationInfo
     * @return array
     */
    public function getNotificationArray(array $data, array $user_phone, $notificationInfo): array
    {
        $url = "test.com";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'URL') {
            $url = "$notificationInfo->external_url";
        }

        $product_code = "0000";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'PURCHASE') {
            $product_code = "$notificationInfo->external_url";
        }

        $subCatSlug = null;
        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'FEED_CATEGORY') {
            $subCatSlug = $notificationInfo->external_url;
        }

        $category_id = !empty($data['category_id']) ? $data['category_id'] : 1;


        if (isset($data['image_url'])) {
            $image_url = env('NOTIFICATION_HOST') . "/" . $data['image_url'] ?? null;
        } else {
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
                'sub_category_slug' => $subCatSlug,
                'navigation_action' => "$notificationInfo->navigate_action"
            ],
        ];
    }

    public function storeScheduledNotification(array $data, array $data1 = null)
    {
        if($data1){
            $data['id']             = $data1['id'];
            $data['title']          = $data1['title'];
            $data["category_id"]    = $data1["category_id"];
            $data["category_slug"]  = $data1["category_slug"];
            $data["category_name"]  = $data1["category_name"];
            $data["image_url"]      = $data1["image_url"];
        }

        try {
            $scheduleArr = explode('-', $data['schedule_time']);

            $notificationDraftId = $data['id'];

            $checkScheduleExists = NotificationSchedule::where('notification_draft_id', $notificationDraftId)->first();
            if (!empty($data['customer_file'])) {
                $uploadedFile = $this->upload($data['customer_file'], 'notification-scheduler-files');
            }

            if ($checkScheduleExists) {
                $data = [
                    'title' => $data['title'],
                    'message' => $data['message'],
                    'file_name' => $uploadedFile ?? $checkScheduleExists->file_name,
                    'start' => Carbon::parse(trim($scheduleArr[0]))->format('Y-m-d H:i:s'),
                    'end' => Carbon::parse(trim($scheduleArr[1]))->format('Y-m-d H:i:s'),
                    'status' => 'active'
                ];
                NotificationSchedule::where('notification_draft_id', $notificationDraftId)->update($data);
            } else {
                $notificationSchedule = new NotificationSchedule();

                $notificationSchedule->notification_draft_id = $notificationDraftId;
                $notificationSchedule->notification_category_id = $data['category_id'];
                $notificationSchedule->title = $data['title'];
                $notificationSchedule->message = $data['message'];
                $notificationSchedule->file_name = $uploadedFile ?? null;
                $notificationSchedule->start = Carbon::parse(trim($scheduleArr[0]))->format('Y-m-d H:i:s');
                $notificationSchedule->end = Carbon::parse(trim($scheduleArr[1]))->format('Y-m-d H:i:s');
                $notificationSchedule->status = 'active';
                $notificationSchedule->save();
            }

            return [
                'success' => true,
                'message' => 'Notification Schedule Stored',
                'quick_notification' => true,
            ];
        } catch (\Exception $e) {
            Log::info('Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function stopSchedule($schedulerId)
    {
        return NotificationSchedule::where('id', $schedulerId)->update(['status' => 'inactive']);
    }

    public function downloadCustomerFile($schedulerId)
    {
        $schedule = NotificationSchedule::find($schedulerId);
        return $this->download($schedule->file_name, 'customers.xlsx');
    }

}
