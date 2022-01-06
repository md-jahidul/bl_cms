<?php

namespace App\Http\Controllers\CMS;

use App\Services\TaskServiceV2;
use App\Services\ProductCoreService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Session;

class EventBaseTaskV2Controller extends Controller
{
    private $taskService;
    private $productCoreService;

    public function __construct(TaskServiceV2 $taskService, ProductCoreService $productCoreService)
    {
        $this->middleware('auth');
        $this->taskService        = $taskService;
        $this->productCoreService = $productCoreService;
    }

    public function index()
    {
        $tasks = $this->taskService->findAll();

        return view('admin.event-base-bonus.tasks.v2.index', compact('tasks'));
    }

    public function create()
    {
        $products = $this->productCoreService->findAll();
        $events   = $this->taskService->eventAll();

        return view('admin.event-base-bonus.tasks.v2.create', compact('products', 'events'));
    }

    public function store(StoreTaskRequest $request)
    {
        $response = $this->taskService->store($request->except('_token'));
        Session::flash('message', 'Task store successful');

        return redirect('/event-base-bonus/v2/tasks');
    }

    public function edit($id)
    {
        $task     = $this->taskService->findOne($id);
        $product_list = $this->productCoreService->findAll();
        $events   = $this->taskService->eventAll();
        $products = [];

        foreach ($product_list as $key => $value) {
            $products[] = $value['product_code'];
        }

        return view('admin.event-base-bonus.tasks.v2.edit', compact('task', 'products', 'events'));
    }

    public function update(StoreTaskRequest $request, $id)
    {
        $response = $this->taskService->update($request->except('_token', '_method'), $id);

        Session::flash('message', 'Task Update successful');

        return redirect('/event-base-bonus/v2/tasks');
    }

    public function destroy($id)
    {
        $response = $this->taskService->delete($id);

        Session::flash('message', 'Task delete successful');

        return redirect('/event-base-bonus/v2/tasks');
    }

    public function delete($id)
    {
        $this->taskService->delete($id);

        return response()->json('delete successful');
    }
}
