<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuickNotificationRequest;
use App\Jobs\NotificationSend;
use App\Models\Customer;
use App\Models\NotificationDraft;
use App\Models\NotificationSchedule;
use App\Repositories\UserMuteNotificationCategoryRepository;
use App\Services\CustomerService;
use App\Services\NotificationService;
use App\Services\PushNotificationSendService;
use App\Services\PushNotificationService;
use App\Traits\CrudTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{
    use CrudTrait;

    /**
     * @var NotificationService
     */
    protected $notificationService;

    /**
     * @var CustomerService
     */
    protected $customerService;


    protected $pushNotificationSendService;
    /**
     * @var UserMuteNotificationCategoryRepository
     */
    private $userMuteNotificationCategoryRepository;

    /**
     * PushNotificationController constructor.
     * @param NotificationService $notificationService
     * @param CustomerService $customerService
     * @param PushNotificationSendService $pushNotificationSendService
     * @param UserMuteNotificationCategoryRepository $userMuteNotificationCategoryRepository
     */
    public function __construct(
        NotificationService $notificationService,
        CustomerService $customerService,
        PushNotificationSendService $pushNotificationSendService,
        UserMuteNotificationCategoryRepository $userMuteNotificationCategoryRepository
    ) {
        $this->notificationService = $notificationService;
        $this->customerService = $customerService;
        $this->pushNotificationSendService = $pushNotificationSendService;
        $this->middleware('auth');
        $this->userMuteNotificationCategoryRepository = $userMuteNotificationCategoryRepository;
    }

    public function saveCustomerListFile(Request $request)
    {
        $file = $request->file('customer_file');
        $path = $file->storeAs(
            'uploads',
            "customer" . '.' . $file->getClientOriginalExtension(),
            'public'
        );

        return $path;
    }

    /**
     * Method that saves file of user base and stores schedule data in the database
     * @param Request $request
     * @return array
     */
    public function sendScheduledNotification(Request $request)
    {
        return $this->pushNotificationSendService->storeScheduledNotification($request->all());
    }

    /**
     * Send Notification
     *
     * @param Request $request
     * @return array
     */
    public function sendNotification(Request $request)
    {
        $userPhones = [];
        $notification_id = $request->input('id');
        $categoryId = $request->input('category_id');
        $notification_data = $request->all();
        $notificationInfo = NotificationDraft::find($notification_id);

        $muteUsersPhone = $this->userMuteNotificationCategoryRepository->getUsersPhoneByCategory($categoryId);

        try {
            $reader = ReaderFactory::createFromType(Type::XLSX);
            $path = $request->file('customer_file')->getRealPath();
            $reader->open($path);

            /*
             * Reading and parsing users from the uploaded spreadsheet
             */
            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) {
                    break;
                }

                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $userPhones [] = $cells[0]->getValue();
                }
            }
            $reader->close();

            /*
             * Preparing chunks after removing users with notification off for this notification category
             */
            $filteredUserPhones = array_diff($userPhones, $muteUsersPhone);
            $filteredUserPhoneChunks = array_chunk($filteredUserPhones, 300);

            /*
             * Dispatching chunks of users to notification send job
             */
            foreach ($filteredUserPhoneChunks as $userPhoneChunk) {
                list($customer, $notification) = $this->checkTargetWise($request, $notificationInfo,
                    $userPhoneChunk, $notification_id, $notification_data);

                NotificationSend::dispatch($notification, $notification_id, $customer,
                    $this->notificationService)
                    ->onQueue('notification');
            }

            Log::info('Success: Notification sending from excel');
            return [
                'success' => true,
                'message' => 'Notification Queued Successfully'
            ];
        } catch (\Exception $e) {
            Log::info('Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Target wise notification Send
     *
     * @param Request $request
     * @return array
     */
    public function targetWiseNotificationSend(Request $request)
    {
        $user_phone = [];
        $notification_id = $request->input('id');
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
            ];
        } catch (\Exception $e) {
            Log::info('Error:' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function quickNotificationStoreAndSend(QuickNotificationRequest $request){

        $notification = $this->notificationService->storeQuickNotification($request);
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
    /**
     * This function only prepare data formated
     */

    public function prepareDataForSendNotification(Request $request, array $customar, $notification_id)
    {

        $notificationInfo = NotificationDraft::find($notification_id);

        $url = "test.com";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'URL') {
            $url = "$notificationInfo->external_url";
        }

        $product_code = "0000";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'PURCHASE') {
            $product_code = "$notificationInfo->external_url";
        }

        $subCatSlug = null;
        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'FEED_CATEGORY') {
            $subCatSlug = "$notificationInfo->external_url";
        }

        $category_id = !empty($request->input('category_id')) ? $request->input('category_id') : 1;

        if ($request->has('image_url')) {
            $image_url = env('NOTIFICATION_HOST') . "/" . $request->input('image_url') ?? null;
        } else {
            $image_url = null;
        }

        return [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            'category_slug' => $request->input('category_slug'),
            'category_name' => $request->input('category_name'),
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $customar,
            "is_interactive" => "Yes",
            "mutable_content" => true,
            "data" => [
                "cid" => "$category_id",
                "url" => "$url",
                "image_url" => $image_url,
                "component" => "offer",
                'product_code' => "$product_code",
                'sub_category_slug' => $subCatSlug,
                'navigation_action' => "$notificationInfo->navigate_action"
            ],
        ];

    }


    /**
     * Send Notification to All customers
     *
     * @param Request $request
     * @return array
     */
    public function sendNotificationToALL(Request $request)
    {
        $user_phone = [];
        $notification_id = $request->input('id');
        $category_id = $request->input('category_id');
        $is_all = $request->input('is_active');

        $notificationInfo = NotificationDraft::find($notification_id);

        $url = "test.com";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'URL') {
            $url = "$notificationInfo->external_url";
        }

        $product_code = "0000";

        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'PURCHASE') {
            $product_code = "$notificationInfo->external_url";
        }

        $subCatSlug = null;
        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'FEED_CATEGORY') {
            $subCatSlug = "$notificationInfo->external_url";
        }


        if ($request->has('image_url')) {
            $image_url = env('NOTIFICATION_HOST') . "/" . $request->input('image_url') ?? null;
        } else {
            $image_url = null;
        }

        try {

            if ($request->filled('user_phone')) {

                $phone_list = explode(",", $request->input('user_phone'));
                $user_phone = $this->notificationService->checkMuteOfferForUser($category_id, $phone_list);

                $notification = [
                    'title' => $request->input('title'),
                    'body' => $request->input('message'),
                    'category_slug' => $request->input('category_slug'),
                    'category_name' => $request->input('category_name'),
                    "sending_from" => "cms",
                    "send_to_type" => "INDIVIDUALS",
                    "recipients" => $user_phone,
                    "is_interactive" => "NO",
                    "mutable_content" => true,
                    "data" => [
                        "cid" => "$category_id",
                        "url" => "$url",
                        "image_url" => $image_url,
                        "component" => "offer",
                        'product_code' => "$product_code",
                        'sub_category_slug' => $subCatSlug,
                        'navigation_action' => "$notificationInfo->navigate_action"
                    ]

                ];
            } else {
                if ($is_all == "1") {

                    $notification = [
                        'title' => $request->input('title'),
                        'body' => $request->input('message'),
                        'category_slug' => $request->input('category_slug'),
                        'category_name' => $request->input('category_name'),
                        "send_to_type" => "ALL",
                        "is_interactive" => "NO",
                        "mutable_content" => true,
                        "data" => [
                            "cid" => "$category_id",
                            "url" => "$url",
                            "image_url" => $image_url,
                            "component" => "offer",
                            'product_code' => "$product_code",
                            'sub_category_slug' => $subCatSlug,
                            'navigation_action' => "$notificationInfo->navigate_action"
                        ]

                    ];
                } else {
                    return ['success' => false, 'message' => 'Input is wrong'];
                }
            }

            /*NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService)
               ->onQueue('notification');

            session()->flash('success', "Notification has been sent successfully");

            return redirect(route('notification.index'));*/

            $response = PushNotificationService::sendNotification($notification);

            Log::info($response);
            $notify = json_decode($response);
            if ($notify->status == "SUCCESS") {
                if ($notify->notification_id != "-1") {
                    if ($request->filled('user_phone')) {
                        $this->notificationService->attachNotificationToUser($notify->notification_id, $user_phone);
                    }
                }
                return ['success' => true, 'message' => 'Notification Sent'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param Request $request
     * @param $notificationInfo
     * @param array $user_phone
     * @param $notification_id
     * @param array $notification_data
     * @return array
     */
    public function checkTargetWise(
        Request $request,
        $notificationInfo,
        array $user_phone,
        $notification_id,
        array $notification_data
    ): array {
        if ($notificationInfo->device_type != "all" || $notificationInfo->customer_type != "all") {
            $customer = $this->customerService->getCustomerList($request, $user_phone, $notification_id);
            $notification = $this->pushNotificationSendService->getNotificationArray($notification_data, $customer,
                $notificationInfo);
        } else {
            $customer = $user_phone;
            $notification = $this->pushNotificationSendService->getNotificationArray($notification_data, $user_phone,
                $notificationInfo);
        }
        return array($customer, $notification);
    }

}
