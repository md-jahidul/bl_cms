<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreTaskRequest;
use App\Services\ProductCoreService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EventBaseTaskController extends Controller
{
    private $taskService;
    private $productCoreService;

    public function __construct(TaskService $taskService, ProductCoreService $productCoreService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
        $this->productCoreService = $productCoreService;
    }

    public function index()
    {
        $tasks = $this->taskService->findAll();

        return view('admin.event-base-bonus.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $products = $this->productCoreService->findAll();
        $events = $this->taskService->eventAll();
        return view('admin.event-base-bonus.tasks.create',compact('products'));
    }

    public function store(StoreTaskRequest $request)
    {
        dd($request->all());
        $response = $this->taskService->store($request->all());

        //Session::flash('message', $response->getContent());
        return redirect('/event-base-bonus/tasks');
    }


    public function edit($id)
    {
        $campaign = $this->taskService->findOne($id);

        return view('admin.campaign.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->taskService->update($request->all(), $id);
        //Session::flash('message', $response->getContent());

        return redirect('/event-base-bonus/tasks');
    }

    public function destroy($id)
    {
        $response = $this->taskService->delete($id);
        //Session::flash('message', $response->getContent());

        return redirect('/event-base-bonus/tasks');
    }
}
