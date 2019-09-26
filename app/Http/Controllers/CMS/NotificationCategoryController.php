<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Http\Requests\NotificationCategoryRequest;

class NotificationCategoryController extends Controller
{

    /**
     * @var NotificationCategoryService
     */
    private $notificationCategoryService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotificationcategoryService constructor.
     * @param NotificationCategoryService $NotificationCategoryService
     */
    public function __construct(NotificationCategoryService $notificationCategoryService)
    {
        $this->notificationCategoryService = $notificationCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificationCategories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification-category.index')->with('notificationCategories',$notificationCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationCategoryRequest $request)
    {
        session()->flash('success',$this->notificationCategoryService->storeNotificationCategory($request->all())->getContent());
        return redirect(route('notificationCategory.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $notificationCategories = $this->notificationCategoryService->findAll();
        $notificationCategory = $this->notificationCategoryService->findOne($id);

        return view('admin.notification.notification-category.index')
                    ->with('notificationCategory',$notificationCategory)
                    ->with('notificationCategories',$notificationCategories);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationCategoryRequest $request, $id)
    { 
        session()->flash('success',$this->notificationCategoryService->updateNotificationCategory($request->all(),$id)->getContent());
        return redirect(route('notificationCategory.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error',$this->notificationCategoryService->deleteNotificationCategory($id)->getContent());
        return url('notificationCategory');
        
    }
}
