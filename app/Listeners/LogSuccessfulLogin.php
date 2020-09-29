<?php

namespace App\Listeners;

use App\Models\AccessLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $log = new AccessLog();
        $log->user_email = $event->user->email;
        $log->ip_address = Request::getClientIp();
        $log->event = 'Login Successful';
        $log->is_success = 1;
        $log->save();
    }
}
