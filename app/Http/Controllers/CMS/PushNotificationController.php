<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Services\PushNotificationService;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{


    /**
     * Send Notification
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendNotification(Request $request)
    {

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
        

        $response = PushNotificationService::sendNotification($notification);

        if(json_decode($response)->status == "SUCCESS"){

            session()->flash('success',"Notification has been sent successfully");

            return redirect(route('notification.index'));
        }

        session()->flash('success',"Notification send Failed");


    }


}
