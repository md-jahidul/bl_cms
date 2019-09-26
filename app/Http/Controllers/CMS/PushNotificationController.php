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
    }


}
