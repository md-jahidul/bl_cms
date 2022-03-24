<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService){

        $this->activityLogService = $activityLogService;
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
        
        return view('admin.activity-logs.view', compact('activityLog', 'data'));
    }
}
