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

    public function searchByDate($request){

        $request['to_date'] = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $request['to_date']))));

        return ActivityLog::whereBetween('logged_at', [$request['from_date'], $request['to_date']])->latest('logged_at')->get();

    }
}
