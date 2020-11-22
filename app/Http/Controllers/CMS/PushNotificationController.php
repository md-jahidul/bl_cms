<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationSend;
use App\Models\Customer;
use App\Models\NotificationDraft;
use App\Models\NotificationSchedule;
use App\Repositories\NotificationScheduleRepository;
use App\Services\CustomerService;
use App\Services\NotificationService;
use App\Services\PushNotificationService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Carbon\Carbon;
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
    use FileTrait;

    /**
     * @var NotificationService
     */
    protected $notificationService;

    /**
     * @var CustomerService
     */
    protected $customerService;
    /**
     * @var NotificationScheduleRepository
     */
    private $notificationSchedulerRepository;
    /**
     * @var NotificationScheduleRepository
     */
    private $notificationScheduleRepository;

    /**
     * PushNotificationController constructor.
     * @param NotificationService $notificationServicen
     * @param CustomerService $customerService
     */
    public function __construct(NotificationService $notificationServicen, CustomerService $customerService)
    {
        $this->notificationService = $notificationServicen;
        $this->customerService = $customerService;
        $this->middleware('auth');
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


    public function sendScheduledNotification(Request $request)
    {
        try {
            $scheduleArr = explode('-', $request->schedule_time);
            $uploadedFile = $this->upload($request->customer_file, 'notification-scheduler-files');

            $notificationSchedule = new NotificationSchedule();

            $notificationSchedule->notification_id = $request->id;
            $notificationSchedule->title = $request->title;
            $notificationSchedule->message = $request->message;
            $notificationSchedule->file_name = $uploadedFile;
            $notificationSchedule->start = Carbon::parse(trim($scheduleArr[0]))->format('Y-m-d H:i:s');
            $notificationSchedule->end = Carbon::parse(trim($scheduleArr[1]))->format('Y-m-d H:i:s');
            $notificationSchedule->status = 'active';

            $notificationSchedule->save();

            return [
                'success' => true,
                'message' => 'Notification Sent'
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
     * Send Notification
     *
     * @param Request $request
     * @return array
     */
    public function sendNotification(Request $request)
    {
        $user_phone = [];
        $notification_id = $request->input('id');
        $category_id = $request->input('category_id');

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
                    $user_phone [] = $number;

                    // $user_phone  = $this->notificationService->checkMuteOfferForUser($category_id, $user_phone_num);

                    if (count($user_phone) == 300) {
                        $notification = $this->getNotificationArray($request, $user_phone);
                        NotificationSend::dispatch($notification, $notification_id, $user_phone,
                            $this->notificationService)
                            ->onQueue('notification');
                        $user_phone = [];
                    }
                }
            }
            $reader->close();

            if (!empty($user_phone)) {
                $notification = $this->getNotificationArray($request, $user_phone);
                NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService)
                    ->onQueue('notification');
            }

            Log::info('Success: Notification sending from excel');
            return [
                'success' => true,
                'message' => 'Notification Sent'
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
                //  dd($notification);
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

    /**
     * This function only prepare data formated
     */

    public function prepareDataForSendNotification(Request $request, array $customar, $notification_id)
    {
        $notificationInfo = NotificationDraft::find($notification_id);
        $url = null;
        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'URL') {
            $url = "$notificationInfo->external_url";
        }

        $PURCHASE = null;
        if (!empty($notificationInfo->navigate_action) && $notificationInfo->navigate_action == 'PURCHASE') {
            $PURCHASE = "$notificationInfo->external_url";
        }
        $category_id = !empty($request->input('category_id')) ? $request->input('category_id') : 1;
        return [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            'category_slug' => $request->input('category_slug'),
            'category_name' => $request->input('category_name'),
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $customar,
            "is_interactive" => "Yes",
            "data" => [
                "cid" => "$category_id",
                "url" => "test.com",
                "component" => "offer"
            ],
        ];

        // "cid" => "$category_id",
        //         // "url" => "$url",
        //         "component" => "offer",
        //         // 'purchase' => "$PURCHASE",
        //         'navigation_action' => "$notificationInfo->navigate_action",

    }

    /**
     * @param Request $request
     * @param array $user_phone
     * @return array
     */
    public function getNotificationArray(Request $request, array $user_phone): array
    {
        return [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            'category_slug' => $request->input('category_slug'),
            'category_name' => $request->input('category_name'),
            "sending_from" => "cms",
            "send_to_type" => "INDIVIDUALS",
            "recipients" => $user_phone,
            "is_interactive" => "NO",
            "data" => [
                "cid" => "1",
                "url" => "test.com",
                "component" => "offer",
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
        $image_url = $request->input('image_url');

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
                    "data" => [
                        "cid" => "1",
                        "url" => "test.com",
                        "image_url" => $image_url,
                        "component" => "offer",
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
                        "data" => [
                            "cid" => "1",
                            "url" => "test.com",
                            "image_url" => $image_url,
                            "component" => "offer",
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
                if ($request->filled('user_phone')) {
                    $this->notificationService->attachNotificationToUser($notify->notification_id, $user_phone);
                }
                return ['success' => true, 'message' => 'Notification Sent'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
