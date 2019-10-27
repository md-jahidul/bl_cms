<?php

namespace App\Jobs;

use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\PushNotificationService;


class NotificationSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $notification;

    protected  $notification_id;

    protected  $user_phone;

    /**
     * @var NotificationService
     */
    protected $notificationService;


    /**
     * Create a new job instance.
     *
     * @param $notification
     * @param $notification_id
     * @param $user_phone
     * @param $notificationService
     */
    public function __construct($notification, $notification_id, $user_phone, $notificationService)
    {
        $this->notification = $notification;

        $this->notification_id = $notification_id;

        $this->user_phone = $user_phone;

        $this->notificationService = $notificationService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = PushNotificationService::sendNotification($this->notification);


        if(json_decode($response)->status == "SUCCESS"){

            if(isset($this->user_phone))
            {
                $this->notificationService->attachNotificationToUser($this->notification_id,  $this->user_phone);
            }

        }
    }
}
