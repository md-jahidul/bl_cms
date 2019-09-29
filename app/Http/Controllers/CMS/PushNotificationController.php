<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{


    /**
     * @param Request $request
     */
    public function sendNotification(Request $request)
    {
        $notification = [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            'send_to_type​' => "​ALL",
            "is_interactive" => "Yes",
            "data" => [
                "cid" => "1",
                "url" => "test.com",
                "component" => "offer",
            ]


       ];

        dd($notification);

    }


}
