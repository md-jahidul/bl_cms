<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Services\FeedCategoryService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Services\NotificationService;
use App\Http\Requests\NotificationRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    protected $feedCategoryService;


    /**
     * NotificationController constructor.
     * @param NotificationService $notificationService
     * @param NotificationCategoryService $notificationCategoryService
     * @param UserService $userService
     */
    public function __construct(
        NotificationService $notificationService,
        NotificationCategoryService $notificationCategoryService,
        UserService $userService,
        FeedCategoryService $feedCategoryService
    ) {
        $this->notificationService = $notificationService;
        $this->notificationCategoryService = $notificationCategoryService;
        $this->userService = $userService;
        $this->feedCategoryService = $feedCategoryService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author ahsan habib <habib.cst@gmail.com>
     */
    public function index()
    {
        $orderBy = ['column' => "starts_at", 'direction' => 'desc'];
        $notifications = $this->notificationService->findAll('', 'schedule', $orderBy);
        $notifications = $notifications->sortByDesc(function ($notification){
            return $notification->schedule ? $notification->schedule->updated_at : $notification->starts_at;
        })->values();
        $category = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.index')
            ->with('category', $category)
            ->with('notifications', $notifications);
    }

    /**
     * @return Application|Factory|View
     * @author ahasan habib <habib.cst@gmail.com>
     */
    public function create()
    {
        $categories = $this->notificationCategoryService->findAll();
        $actionList = Helper::navigationActionList();
        return view('admin.notification.notification.create', compact('categories', 'actionList'));
    }


    /**
     * @param NotificationRequest $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    * @author ahasan habib <habib.cst@gmail.com>
     */
    public function store(NotificationRequest $request)
    {
        $content = $this->notificationService->storeNotification($request)->getContent();
        session()->flash('message', $content);
        return redirect(route('notification.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|\Illuminate\Http\Response|View
     */
    public function show($id)
    {
        $notification = $this->notificationService->findOne($id, ['NotificationCategory', 'schedule']);
        $schedule = $notification ? $notification->schedule : null;
        $scheduleStatus = $schedule ? $schedule->status : 'none';
        $users = $this->userService->getUserListForNotification();

        return view(
            'admin.notification.notification.show',
            compact('notification', 'users', 'schedule', 'scheduleStatus')
        );
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showAll($id)
    {
        $notification = $this->notificationService->findOne($id, 'NotificationCategory');

        $users = $this->userService->getUserListForNotification();

        return view('admin.notification.notification.show-all')
            ->with('notification', $notification)
            ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $categories = $this->notificationCategoryService->findAll();
        $actionList = Helper::navigationActionList();
        $feedCategories = $this->feedCategoryService->findAll();
        return view('admin.notification.notification.edit')
            ->with('categories', $categories)
            ->with('actionList', $actionList)
            ->with('feedCategories', $feedCategories)
            ->with('notification', $this->notificationService->findOne($id));
    }

    /**
     * @param NotificationRequest $request
     * @param $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author ahasan habib <habib.cst@gmail.com>
     */
    public function update(NotificationRequest $request, $id)
    {
        $content = $this->notificationService->updateNotification($request, $id)->getContent();
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


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function getNotificationReport()
    {
        $notifications = $this->notificationService->getNotificationReport();
        return view('admin.notification.notification.list')
            ->with('notifications', $notifications);
    }

    /**
     * Display push notification defult report.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTargetWiseNotificationReport(Request $request){


        if ($request->has('draw')){
            return $this->notificationService->getNotificationListReport($request);
        }

        if ($request->isMethod('get')) {
            return view('admin.notification.target-wise-notification.list');
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTargetWiseNotificationReportDetails(Request $request,$title)
    {

        $notifications = $this->notificationService->getNotificationTargetwiseReport($title);
    //    dd($notifications);

        return view('admin.notification.target-wise-notification.details')
            ->with('notifications', $notifications);
    }

    public function getProductList(Request $request){
        
        return $this->notificationService->getActiveProducts($request);
    }
}
