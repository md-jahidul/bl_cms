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
       dd($request->input('title'));

       $data = [
           'title' =>  $request->input('title'),
           'body'  =>   $request->input('title'),

       ];



       $data ['title'] = $request->input('title');

        $data ['body'] = $request->input('title');

        "title"​ : ​ " সরা অফার!" ,
"body"​ : " ​ বাংলািলংক আপনার জন িনেয় এেসেছ ১ পয়সা/ সেক
"send_to_type"​ : ​ "ALL"​ ,
"is_interactive"​ : ​ "'Yes"​ ,
"data"​ : {
"cid"​ : ​ "1"​ ,
"url"​ : ​ "https://xxxxx.xxx"​ ,
"component"​ : ​ "offer"

    }


}
