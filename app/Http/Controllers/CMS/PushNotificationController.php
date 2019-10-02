<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Jobs\NotificationSend;
use App\Services\NotificationService;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{


    /**
     * @var NotificationService
     */
    protected $notificationService;


    /**
     * PushNotificationController constructor.
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Send Notification
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendNotification(Request $request)
    {

        $notification_id = $request->input('id');

        if($request->filled('user_phone'))
        {
            $notification = [
                'title' => $request->input('title'),
                'body' => $request->input('message'),
                "send_to_type" => "INDIVIDUALS" ,
                "recipients" => $request->input('user_phone'),
                "is_interactive" => "Yes",
                "data" => [
                    "cid" => "1",
                    "url" => "test.com",
                    "component" => "offer",
                ]

            ];
        } else {

            $notification = [
                'title' => $request->input('title'),
                'body' => $request->input('message'),
                "send_to_type" => "ALL",
                "is_interactive" => "Yes",
                "data" => [
                    "cid" => "1",
                    "url" => "test.com",
                    "component" => "offer",
                ]

            ];
        }


        /*NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService);

        session()->flash('success',"Notification has been sent successfully");

        return redirect(route('notification.index'));*/


        $response = PushNotificationService::sendNotification($notification);


        if(json_decode($response)->status == "SUCCESS"){

            if($request->filled('user_phone'))
            {
                $user_phone = $request->input('user_phone');

                $this->notificationService->attachNotificationToUser($notification_id, $user_phone);
            }

            session()->flash('success',"Notification has been sent successfully");

            return redirect(route('notification.index'));
        }

        session()->flash('success',"Notification send Failed");


    }

}
