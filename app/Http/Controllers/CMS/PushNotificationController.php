<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationSend;
use App\Services\NotificationService;
use App\Services\PushNotificationService;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class PushNotificationController
 * @package App\Http\Controllers\CMS
 */
class PushNotificationController extends Controller
{


    /**
     * @var NotificationService
     */
    protected $notificationService;


    /**
     * PushNotificationController constructor.
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
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

            /**
             *  save the excel file
             */

            $file_path = $this->saveCustomerListFile($request);

            /**
             *  read the excel file
             */

            $fileLoc = Storage::disk('public')->path($file_path);

            $reader = ReaderFactory::createFromType(Type::XLSX);
            $reader->open($fileLoc);

            $customer_array = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) {
                    break;
                }

                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->getCells();
                    $number = $cells[0]->getValue();
                    $customer_array [] = $number;
                }
            }
            $reader->close();

            $collection = collect($customer_array);
            $chunks = $collection->chunk(100);
            $chunks->toArray();


            foreach ($chunks as $key => $chunk) {
                $user_phone = $this->notificationService->checkMuteOfferForUser($category_id, $chunk->toArray());

                $notification = [
                    'title' => $request->input('title'),
                    'body' => $request->input('message'),
                    'category_slug' => $request->input('category_slug'),
                    'category_name' => $request->input('category_name'),
                    "send_to_type" => "INDIVIDUALS",
                    "recipients" => $user_phone,
                    "is_interactive" => "Yes",
                    "data" => [
                        "cid" => "1",
                        "url" => "test.com",
                        "component" => "offer",
                    ]
                ];

/*                NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService)
                    ->onQueue('notification');*/

                $response = PushNotificationService::sendNotification($notification);
                $formatted_response = json_decode($response);
                if ($formatted_response->status == "SUCCESS") {
                    if (isset($user_phone)) {
                        $this->notificationService->attachNotificationToUser($formatted_response->notification_id, $user_phone);
                    }
                }
            }

            return [
                'success' => true,
                'message' => 'Notification Sent'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }


    /**
     * Send Notification
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendNotification_ALL(Request $request)
    {
        $user_phone = [];
        $notification_id = $request->input('id');
        $category_id = $request->input('category_id');

        if ($request->filled('user_phone')) {
            $phone_list = $request->input('user_phone');

            $user_phone  = $this->notificationService->checkMuteOfferForUser($category_id, $phone_list);

            $notification = [
                'title' => $request->input('title'),
                'body' => $request->input('message'),
                'category_slug' => $request->input('category_slug'),
                'category_name' => $request->input('category_name'),
                "send_to_type" => "INDIVIDUALS" ,
                "recipients" => $user_phone,
                "is_interactive" => "Yes",
                "data" => [
                    "cid" => "1",
                    "url" => "test.com",
                    "component" => "offer",
                ]

            ];
        } else {
            $notification = [
                'title' => $request->input('title'),
                'body' => $request->input('message'),
                'category_slug' => $request->input('category_slug'),
                'category_name' => $request->input('category_name'),
                "send_to_type" => "ALL",
                "is_interactive" => "Yes",
                "data" => [
                    "cid" => "1",
                    "url" => "test.com",
                    "component" => "offer",
                ]

            ];
        }


        NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService)
            ->onQueue('notification');

        session()->flash('success', "Notification has been sent successfully");

        return redirect(route('notification.index'));


        /* $response = PushNotificationService::sendNotification($notification);


         if(json_decode($response)->status == "SUCCESS"){

             if($request->filled('user_phone'))
             {
                 $this->notificationService->attachNotificationToUser($notification_id, $user_phone);
             }

             session()->flash('success',"Notification has been sent successfully");

             return redirect(route('notification.index'));
         }

         session()->flash('success',"Notification send Failed");*/
    }
}
