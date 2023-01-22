<?php

namespace App\Http\Controllers\CMS\NotificationV2;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Services\NotificationService;
use App\Services\NotifiationV2\NotificationV2Service;
use App\Http\Requests\NotificationRequest;
use App\Services\NotifiationV2\CustomerDeviceSyncService;
use App\Services\NotifiationV2\NotificationCategoryV2Service;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NotificationV2Controller extends Controller
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
     * @var NotificationV2Service
     */
    protected $notificationV2Service, $notificationCategoryV2Service;

    /**
     * @var CustomerDeviceSyncService
     */
    protected $customerDeviceSyncService;
    /**
     * NotificationController constructor.
     * @param NotificationService $notificationService
     * @param NotificationCategoryService $notificationCategoryService
     * @param UserService $userService
     */
    public function __construct(
        NotificationService             $notificationService,
        NotificationCategoryService     $notificationCategoryService,
        UserService                     $userService,
        NotificationV2Service           $notificationV2Service,
        NotificationCategoryV2Service   $notificationCategoryV2Service,
        CustomerDeviceSyncService       $customerDeviceSyncService
    )
    {
        $this->notificationService              = $notificationService;
        $this->notificationCategoryService      = $notificationCategoryService;
        $this->userService                      = $userService;
        $this->notificationV2Service            = $notificationV2Service;
        $this->notificationCategoryV2Service    = $notificationCategoryV2Service;
        $this->customerDeviceSyncService        = $customerDeviceSyncService;
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
        $notifications = $this->notificationV2Service->findAll('', '', $orderBy);
        $notifications = $notifications['data'];
        $category = $this->notificationCategoryV2Service->findAll();
    
        return view('admin.notification_v2.notification.index')
            ->with('category', $category['data'])
            ->with('notifications', $notifications);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author ahasan habib <habib.cst@gmail.com>
     */
    public function create()
    {
        $categories = $this->notificationCategoryV2Service->findAll();
        // dd($categories['data']);
        return view('admin.notification_v2.notification.create')->with('categories', $categories['data']);
    }


    /**
     * @param NotificationRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    * @author ahasan habib <habib.cst@gmail.com>
     */
    public function store(Request $request)
    {

        $content = $this->notificationV2Service->storeNotificationDraft($request->all());
        session()->flash('success', $content);

        return redirect(route('notification-v2.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        // $notification = $this->notificationService->findOne($id, ['NotificationCategory', 'schedule']);
        // $schedule = $notification ? $notification->schedule : null;
        // $scheduleStatus = $schedule ? $schedule->status : 'none';
        // $users = $this->userService->getUserListForNotification();

        // return view(
        //     'admin.notification_v2.notification.show',
        //     compact('notification', 'users', 'schedule', 'scheduleStatus')
        // );

        $notificationDraft = $this->notificationV2Service->findOneById($id);
        $notification = $notificationDraft['data'];
        $scheduleStatus =  'active';
        $schedule = [
            'starts_at' => Carbon::now(),
            'expires_at' => Carbon::now()
        ];
        $notificationCategory = [
            'id' => $notification['notification_category']['_id']['$oid'],
            'name' => $notification['notification_category']['name'],
            'slug' =>  $notification['notification_category']['slug']
        ];
       
        return view(
            'admin.notification_v2.notification.show',
            compact('notification', 'notificationCategory', 'scheduleStatus', 'schedule')
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

        return view('admin.notification_v2.notification.show-all')
            ->with('notification', $notification)
            ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->notificationCategoryV2Service->findAll();
        $notificationDraft = $this->notificationV2Service->findOneById($id);

        // dd($categories['data'], $notificationDraft['data']);

        return view('admin.notification_v2.notification.edit')
            ->with('categories', $categories['data'])
            ->with('notification', $notificationDraft['data']);
    }

    /**
     * @param NotificationRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author ahasan habib <habib.cst@gmail.com>
     */
    public function update(Request $request)
    {
        $content = $this->notificationV2Service->updateNotification($request->all());
        session()->flash('success', $content);
        
        return redirect(route('notification-v2.index'));
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
     * @return \Illuminate\Http\Response
     */
    public function getNotificationReport()
    {
        $notifications = $this->notificationService->getNotificationReport();

        return view('admin.notification_v2.notification.list')
            ->with('notifications', $notifications);
    }

    /**
     * Display push notification defult report.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTargetWiseNotificationReport(Request $request){

            $allNotifications = $this->notificationV2Service->getTargetWiseNotificationReport();

            $notifications = array();

            foreach ($allNotifications['data'] as $notification)
            {
                $id = (array)$notification["_id"];
                $notification['id'] = $id['$oid'];
                
                $notifications [] = $notification;
            }

            return view('admin.notification_v2.target-wise-notification.list')
                        ->with('allNotifications', $notifications);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTargetWiseNotificationReportDetails($notificationId)
    {

        $data = $this->notificationV2Service->getNotificationTargetwiseReport($notificationId);
        $usersNotification = $data['data'];
        $notification = $usersNotification[0]['notification_info'];

        return view('admin.notification_v2.target-wise-notification.details')
            ->with('usersNotification', $usersNotification)
            ->with('notification', $notification);
    }

    public function getProductList(Request $request){
        return $this->notificationService->getActiveProducts($request);
    }

    public function targetWiseNotificationSend(Request $request)
    {
        $path = $request->file('customer_file')->getRealPath();
        $temp = Storage::disk('excel_uploads')->put($path, $request->customer_file);
        $file_name = $temp;
        $finalPath = explode("tmp/", $file_name)[1];
        $time = (explode("-",$request->schedule_time));
        $time[0] = date("Y-m-d H:i:s", strtotime("+0 minutes",strtotime($time[0])));
        $time[1] = date("Y-m-d H:i:s", strtotime("+2 minutes",strtotime($time[1])));
        $this->notificationV2Service->createNotificationSchedule($request->all(), $finalPath, $time);

        return [
            "message" => "Notification Schedule Saved Successfully"
        ];
    }

    public function freshSync(){

        $this->customerDeviceSyncService->freshSync();

        return "Successfully sync table";
    }

    public function test()
    {
        $allCustomersAndMsisdns =  $this->customerDeviceSyncService->getCustomersDevices();

        $this->customerDeviceSyncService->pushCustomersDevicesTable($allCustomersAndMsisdns);

        return "Database Sync Successfully";
    }
}
