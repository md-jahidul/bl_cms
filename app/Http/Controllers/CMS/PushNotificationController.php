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
    }

    public function saveCustomerListFile(Request $request)
    {
        $file = $request->file('customer_file');
        $path = $file->storeAs('uploads', md5($file->getClientOriginalName() . Str::random()) . '.' . $file->getClientOriginalExtension(), 'public');

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

            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
            $reader->open($fileLoc);

            $customer_array = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) break; // only first sheet

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
                    "send_to_type" => "INDIVIDUALS",
                    "recipients" => $user_phone,
                    "is_interactive" => "Yes",
                    "data" => [
                        "cid" => "1",
                        "url" => "test.com",
                        "component" => "offer",
                    ]
                ];

                NotificationSend::dispatch($notification, $notification_id, $user_phone, $this->notificationService)
                    ->onQueue('notification');
/*                $response = PushNotificationService::sendNotification($notification);

                dd($response);


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

/*        $notification = [
            'title' => $request->input('title'),
            'body' => $request->input('message'),
            "send_to_type" => "ALL",
            "is_interactive" => "Yes",
            "data" => [
                "cid" => "1",
                "url" => "test.com",
                "component" => "offer",
            ]
        ];*/

    }

}
