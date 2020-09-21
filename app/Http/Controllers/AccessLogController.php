<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    public function index()
    {
        $accessLogs = AccessLog::latest()->get();
        return view('admin.access-logs.index', compact('accessLogs'));
    }
}
