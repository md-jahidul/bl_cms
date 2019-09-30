<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Services\NotificationService;
use App\Http\Requests\NotificationRequest;

class NotificationController extends Controller
{

    /**
     * @var NotificationService
     */
    private $NotificationService;
    private $notificationCategoryService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * NotificationService constructor.
     * @param NotificationService $Notificationervice
     */
    public function __construct(NotificationService $notificationService,NotificationCategoryService $notificationCategoryService)
    {
        $this->notificationService = $notificationService;
        $this->notificationCategoryService = $notificationCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notifications = $this->notificationService->findAll();
        $cat =  $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.index')
                ->with('cat',$cat)
                ->with('notifications',$notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        //dd($request->all());
        session()->flash('message',$this->notificationService->storeNotification($request->all())->getContent());
        return redirect(route('notification.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = $this->notificationService->findOne($id);
        return view('admin.notification.notification.show')->with('notification',$notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.edit')
                ->with('categories',$categories)
                ->with('notification',$this->notificationService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, $id)
    {
        //dd($request);
        session()->flash('success',$this->notificationService->updateNotification($request->all(),$id)->getContent());
        return redirect(route('notification.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        session()->flash('error',$this->notificationService->deleteNotification($id)->getContent());
        return url('notificationCategory');
    }
}
