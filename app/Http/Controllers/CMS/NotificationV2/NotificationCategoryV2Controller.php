<?php

namespace App\Http\Controllers\CMS\NotificationV2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Http\Requests\NotificationCategoryRequest;
use App\Services\NotifiationV2\NotificationCategoryV2Service;
use Illuminate\Http\Response;

class NotificationCategoryV2Controller extends Controller
{

    /**
     * @var NotificationCategoryService
     */
    private $notificationCategoryService, $notificationCategoryV2Service;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotificationcategoryService constructor.
     * @param NotificationCategoryService $notificationCategoryService
     */
    public function __construct(NotificationCategoryService $notificationCategoryService, NotificationCategoryV2Service $notificationCategoryV2Service)
    {
        $this->notificationCategoryService = $notificationCategoryService;
        $this->notificationCategoryV2Service = $notificationCategoryV2Service;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $notificationCategories = $this->notificationCategoryV2Service->findAll();
        
        return view('admin.notification_v2.notification-category.index')->with('notificationCategories', $notificationCategories['data']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.notification_v2.notification-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        session()->flash('success', $this->notificationCategoryV2Service->storeNotificationCategory($request->all())->getContent());

        return redirect(route('notificationCategory-v2.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    
        $notificationCategory = $this->notificationCategoryV2Service->findOneById($id);
        return view('admin.notification_v2.notification-category.create')
                    ->with('notificationCategory', $notificationCategory['data']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        session()->flash('success',  $this->notificationCategoryV2Service->updateNotificationCategory($request->all())->getContent());
    
        return redirect(route('notificationCategory-v2.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->notificationCategoryV2Service->deleteNotificationCategory($id)->getContent());

        return url('notificationCategory-v2');
    }
}
