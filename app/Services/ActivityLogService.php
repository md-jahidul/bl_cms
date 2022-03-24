<?php

namespace App\Services;

use App\ActivityLog;
use Illuminate\Http\Response;

class ActivityLogService
{
    public function findAll(){

        return ActivityLog::latest('logged_at')->get();
    }

    public function findById($activityLogId){

        return ActivityLog::find($activityLogId);
    }

}
