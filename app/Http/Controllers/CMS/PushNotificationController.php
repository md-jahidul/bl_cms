<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendNotification(Request $request)
    {
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


        $response = PushNotificationService::sendNotification($notification);

        session()->flash('success',$response);

        return redirect(route('notification.send'));

    }


}
