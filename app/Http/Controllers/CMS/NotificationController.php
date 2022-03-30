<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Services\FeedCategoryService;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\NotificationCategoryService;
use App\Services\NotificationService;
use App\Http\Requests\NotificationRequest;
use App\Jobs\NotificationSend;
use App\Models\NotificationDraft;
use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use App\Services\PushNotificationSendService;

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
    protected $customerService;


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
        CustomerService $customerService
    )
    {
        $this->notificationService = $notificationService;
        $this->notificationCategoryService = $notificationCategoryService;
        $this->userService = $userService;
        $this->customerService = $customerService;
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
        $notifications = $this->notificationService->findAll('', 'schedule', $orderBy)->where('quick_notification', false);
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
        // dd($request->all());

        if($request->type == 'only_save'){
            $content = $this->notificationService->storeNotification($request)->getContent();
            session()->flash('message', $content);
            return [
                'success' => true,
                'message' => $content,
                'quick_notification' => false,
            ];
        }

        else{

            $notification = $this->notificationService->storeNotification($request);
            $id = $notification['id'];
            $schedule = $notification ? $notification->schedule : null;
            $request['title']          = $notification->title;
            $request["category_id"]    = $notification->NotificationCategory->id;
            $request["category_slug"]  = $notification->NotificationCategory->slug;
            $request["category_name"]  = $notification->NotificationCategory->name;
            $request["image_url"]      = $notification->image;
            $request['id']             = $id;
            $request['message']        = $notification['body'];
            $data = $request->all();
            $flag =  isset($request->is_scheduled) ? 1 : 0 ;

            if(!$flag){
                $user_phone = [];
                $notification_id = $id;
                // $category_id = $request->input('category_id');
                try {
                    $reader = ReaderFactory::createFromType(Type::XLSX);
                    $path = $request->file('customer_file')->getRealPath();
                    $reader->open($path);

                    foreach ($reader->getSheetIterator() as $sheet) {
                        if ($sheet->getIndex() > 0) {
                            break;
                        }

                        foreach ($sheet->getRowIterator() as $row) {
                            $cells = $row->getCells();
                            $number = $cells[0]->getValue();
                            $user_phone[] = $number;
                            // $user_phone  = $this->notificationService->checkMuteOfferForUser($category_id, $user_phone_num);

                            if (count($user_phone) == 300) {
                                $customar = $this->customerService->getCustomerList($request, $user_phone, $notification_id);
                                $notification = $this->prepareDataForSendNotification($request, $customar, $notification_id);
                                NotificationSend::dispatch($notification, $notification_id, $user_phone,
                                    $this->notificationService)
                                    ->onQueue('notification');
                                $user_phone = [];
                            }
                        }
                    }
                    $reader->close();
                    if (!empty($user_phone)) {
                        $customar = $this->customerService->getCustomerList($request, $user_phone, $notification_id);
                        $notification = $this->prepareDataForSendNotification($request, $customar, $notification_id);
                        // $notification = $this->getNotificationArray($request, $user_phone);
                        NotificationSend::dispatch($notification, $notification_id, $customar, $this->notificationService)
                            ->onQueue('notification');

                    }

                    Log::info('Success: Notification sending from excel');
                    return [
                        'success' => true,
                        'message' => 'Notification Sent',
                        'quick_notification' => true,
                    ];
                } catch (\Exception $e) {
                    Log::info('Error:' . $e->getMessage());
                    return [
                        'success' => false,
                        'message' => $e->getMessage(),
                    ];
                }
            }
            else {
                return $this->pushNotificationSendService->storeScheduledNotification($request->all(), $data);
            }
        }
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
        $quick_notification = $request->quick_notification;
        $content = $this->notificationService->updateNotification($request, $id)->getContent();
        session()->flash('success', $content);

        if($quick_notification==1){
            return redirect(route('quick-notification.index'));
        }

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
    public function getTargetWiseNotificationReport(Request $request)
    {


        if ($request->has('draw')) {
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
    public function getTargetWiseNotificationReportDetails(Request $request, $title)
    {

        $notifications = $this->notificationService->getNotificationTargetwiseReport($title);
        //    dd($notifications);

        return view('admin.notification.target-wise-notification.details')
            ->with('notifications', $notifications);
    }

    public function getProductList(Request $request){

        return $this->notificationService->getActiveProducts($request);
    }

    public function duplicateNotification($notificationId){

        $data = $this->notificationService->findOne($notificationId);
        $content = $this->notificationService->storeDuplicateNotification($data->toArray())->getContent();
        session()->flash('message', $content);
        
        return redirect(route('quick-notification.index'));
        
    }

    public function quickNotificationIndex(){
        $orderBy = ['column' => "starts_at", 'direction' => 'desc'];
        $notifications = $this->notificationService->findAll('', 'schedule', $orderBy)->where('quick_notification', true);;
        $notifications = $notifications->sortByDesc(function ($notification){
            return $notification->schedule ? $notification->schedule->updated_at : $notification->starts_at;
        })->values();
        $category = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.quick_notification_index')
            ->with('category', $category)
            ->with('notifications', $notifications);
    }

    public function quickNotificationCreate(){
        $categories = $this->notificationCategoryService->findAll();
        return view('admin.notification.notification.quick_notification_create')->with('categories', $categories);
    }
}
