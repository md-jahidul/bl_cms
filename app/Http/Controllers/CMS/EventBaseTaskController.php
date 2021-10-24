<?php

namespace App\Http\Controllers\CMS;

use App\Services\TaskService;
use App\Services\ProductCoreService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Session;

class EventBaseTaskController extends Controller
{
    private $taskService;
    private $productCoreService;

    public function __construct(TaskService $taskService, ProductCoreService $productCoreService)
    {
        $this->middleware('auth');
        $this->taskService        = $taskService;
        $this->productCoreService = $productCoreService;
    }

    public function index()
    {
        Session::forget('message');
        $tasks = $this->taskService->findAll();

        if (isset($tasks['message'])) {
            Session::flash('message', $tasks['message']);
            $tasks = [];
        }

        return view('admin.event-base-bonus.tasks.index', compact('tasks'));
    }

    public function create()
    {
        Session::forget('message');
        $products = $this->productCoreService->findAll();
        $events   = $this->taskService->eventAll();

        if (isset($events['message'])) {
            Session::flash('message', $events['message']);
            $events = [];
        }

        return view('admin.event-base-bonus.tasks.create', compact('products', 'events'));
    }

    public function store(StoreTaskRequest $request)
    {
        $response = $this->taskService->store($request->except('_token'));

        if (isset($events['message'])) {
            Session::flash('message', $events['message']);
        } else {
            Session::flash('message', 'Task store successful');
        }

        return redirect('/event-base-bonus/tasks');
    }

    public function edit($id)
    {
        Session::forget('message');
        $task     = $this->taskService->findOne($id);
        $products = $this->productCoreService->findAll();
        $events   = $this->taskService->eventAll();

        if (isset($task['message'])) {
            Session::flash('message', $task['message']);
            $task = [];
        }

        return view('admin.event-base-bonus.tasks.edit', compact('task', 'products', 'events'));
    }

    public function update(StoreTaskRequest $request, $id)
    {
        $response = $this->taskService->update($request->except('_token', '_method'), $id);

        if (isset($task['message'])) {
            Session::flash('message', $task['message']);
            $task = [];
        } else {
            Session::flash('message', 'Task Update successful');
        }

        return redirect('/event-base-bonus/tasks');
    }

    public function destroy($id)
    {
        $response = $this->taskService->delete($id);

        Session::flash('message', 'Task delete successful');

        return redirect('/event-base-bonus/tasks');
    }
}
