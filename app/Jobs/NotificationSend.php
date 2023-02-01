<?php

namespace App\Jobs;

use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;
use Illuminate\Support\Facades\Log;

class NotificationSend implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    protected $notification;

    protected $notification_id;

    protected $user_phone;

    /**
     * @var NotificationService
     */
    protected $notificationService;
    /**
     * @var null
     */
    private $schedule;


    /**
     * Create a new job instance.
     *
     * @param $notification
     * @param $notification_id
     * @param $user_phone
     * @param $notificationService
     * @param null $schedule
     */
    public function __construct($notification, $notification_id, $user_phone, $notificationService, $schedule = null)
    {
        $this->notification = $notification;
        $this->notification_id = $notification_id;
        $this->user_phone = $user_phone;
        $this->notificationService = $notificationService;
        $this->schedule = $schedule;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scheduleEnds = !is_null($this->schedule) ? (optional($this->schedule)->end ?? null) : null;
        $currentTime = Carbon::now()->toDateTimeString();
        if ($scheduleEnds && $scheduleEnds < $currentTime) {
            //TODO:: Add missing msisdns to db
            Log::channel('notificationinfolog')->info('notification-send-missing-msisdns: Schedule Ends - ' . $scheduleEnds . " Process Time" . $currentTime . "-- Count:" . count($this->user_phone) , $this->user_phone);
        } else {
            $response = PushNotificationService::sendNotification($this->notification);

            try {
                $formatted_response = json_decode($response);
                if ($formatted_response->status == "SUCCESS") {
                    if ($formatted_response->notification_id !== "-1") {
                        if (isset($this->user_phone)) {
                            $this->notificationService->attachNotificationToUser($formatted_response->notification_id,
                                $this->user_phone);
                        }
                    }
                }
            } catch (\Exception $ex) {


            }


        }
    }
}
