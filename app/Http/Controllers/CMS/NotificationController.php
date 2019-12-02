<?php

namespace App\Http\Controllers\CMS;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Services\NotificationService;
use App\Http\Requests\NotificationRequest;

class NotificationController extends Controller
{

    /**
     * @var NotificationService
     */
    protected $notificationService;

    /**
     * @var NotificationCategoryService
     */
    protected $notificationCategoryService;

    /**
     * @var UserService
     */
    protected $userService;


    /**
     * NotificationController constructor.
     * @param NotificationService $notificationService
     * @param NotificationCategoryService $notificationCategoryService
     * @param UserService $userService
     */
    public function __construct(
        NotificationService $notificationService,
        NotificationCategoryService $notificationCategoryService,
        UserService $userService
    ) {
        $this->notificationService = $notificationService;
        $this->notificationCategoryService = $notificationCategoryService;
        $this->userService = $userService;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notifications = $this->notificationService->findAll();
        $category =  $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.index')
                ->with('category', $category)
                ->with('notifications', $notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        $content = $this->notificationService->storeNotification($request->all())->getContent();
        session()->flash('message', $content);
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
        $notification = $this->notificationService->findOne($id, 'NotificationCategory');

        $users = $this->userService->getUserListForNotification();

        return view('admin.notification.notification.show')
            ->with('notification', $notification)
            ->with('users', $users);
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
                ->with('categories', $categories)
                ->with('notification', $this->notificationService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, $id)
    {
        $content = $this->notificationService->updateNotification($request->all(), $id)->getContent();
        session()->flash('success', $content);
        return redirect(route('notification.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        session()->flash('error', $this->notificationService->deleteNotification($id)->getContent());
        return url('notificationCategory');
    }
}
