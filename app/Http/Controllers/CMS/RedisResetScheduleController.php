<?php

namespace App\Http\Controllers\CMS;

use App\Services\RedisResetScheduleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedisResetScheduleController extends Controller
{
    /**
     * @var RedisResetScheduleService
     */
    private $redisResetScheduleService;

    /**
     * RedisResetScheduleController constructor.
     * @param RedisResetScheduleService $redisResetScheduleService
     */
    public function __construct(RedisResetScheduleService $redisResetScheduleService)
    {
        $this->redisResetScheduleService = $redisResetScheduleService;
    }

    public function index()
    {
        $schedules = $this->redisResetScheduleService->findAll(null, null,
            ['column' => 'updated_at', 'direction' => 'desc']);
        $entryType = 'create';
        return view('admin.my-bl-products.redis-reset-schedule.index', compact('schedules', 'entryType'));
    }

    public function edit($id)
    {
        $schedules = $this->redisResetScheduleService->findAll(null, null,
            ['column' => 'updated_at', 'direction' => 'desc']);
        $editingSchedule = $this->redisResetScheduleService->findOne($id);
        $entryType = 'edit';
        return view('admin.my-bl-products.redis-reset-schedule.index',
            compact('schedules', 'entryType', 'editingSchedule'));
    }

    public function store(Request $request)
    {
        if ($this->redisResetScheduleService->storeData($request->all())) {
            $response = ['type' => 'success', 'message' => 'Schedule stored and activated successfully'];
        } else {
            $response = ['type' => 'error', 'message' => 'Schedule was not stored successfully!'];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }

    public function update(Request $request, $id)
    {
        if ($this->redisResetScheduleService->updateData($id, $request->all())) {
            $response = ['type' => 'success', 'message' => 'Schedule update successfully'];
        } else {
            $response = ['type' => 'error', 'message' => 'Schedule was not updated successfully!'];
        }

        return redirect()->route('redis-reset-schedules.index')->with($response['type'], $response['message']);
    }

    public function toggleStatus($id)
    {
        if ($this->redisResetScheduleService->toggleStatus($id)) {
            $response = ['type' => 'success', 'message' => 'Schedule updated successfully!'];
        } else {
            $response = ['type' => 'error', 'message' => 'Schedule was not updated successfully!'];
        }

        return redirect()->back()->with($response['type'], $response['message']);
    }
}
