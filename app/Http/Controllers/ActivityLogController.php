<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Services\ActivityLogService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    protected $activityLogService, $userService;
    
    public function __construct(ActivityLogService $activityLogService, UserService $userService){

        $this->activityLogService = $activityLogService;
        $this->userService = $userService;
    }

    public function index()
    {
        $activityLogs = $this->activityLogService->findAll();
       
        return view('admin.activity-logs.index', compact('activityLogs'));
    }

    public function show($activityLogId)
    {
        $activityLog = $this->activityLogService->findById($activityLogId);
        $data = json_decode($activityLog['data'], true);
        $flag = false;
        $user = $this->userService->findById($activityLog->user_id);
       
        if(isset($data['before']))$flag= true;

        return view('admin.activity-logs.view', compact('activityLog', 'data', 'flag', 'user'));
    }

    public function search(Request $request){

        $activityLogs = $this->activityLogService->searchByDate($request->all());
       
        return view('admin.activity-logs.index', compact('activityLogs'));
    }
}
