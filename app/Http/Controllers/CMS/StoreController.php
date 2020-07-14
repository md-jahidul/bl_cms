<?php

namespace App\Http\Controllers;

use App\Services\StoreCategoryService;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * @var StoreService
     */
    protected $storeService;

    /**
     * @var StoreCategoryService
     */
    protected $storeCategoryService;


    /**
     * StoreController constructor.
     * @param StoreService $storeService
     * @param StoreCategoryService $storeCategoryService
     */
    public function __construct(
        StoreService $storeService,
        StoreCategoryService $storeCategoryService
    ) {
        $this->storeService = $storeService;
        $this->storeCategoryService = $storeCategoryService;
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $notifications = $this->storeService->findAll();
        $category =  $this->storeCategoryService->findAll();
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
        $categories = $this->storeCategoryService->findAll();
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
        $content = $this->storeService->storeNotification($request->all())->getContent();
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
        $notification = $this->storeService->findOne($id, 'NotificationCategory');

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
        $categories = $this->storeCategoryService->findAll();
        return view('admin.notification.notification.edit')
            ->with('categories', $categories)
            ->with('notification', $this->storeService->findOne($id));
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
        $content = $this->storeService->updateNotification($request->all(), $id)->getContent();
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
        session()->flash('error', $this->storeService->deleteNotification($id)->getContent());
        return url('notificationCategory');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotificationReport()
    {
        $notifications = $this->storeService->getNotificationReport();

        return view('admin.notification.notification.list')
            ->with('notifications', $notifications);
    }
}
