<?php

namespace App\Services;


use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Traits\FileTrait;
use App\Models\MyBlProduct;
use App\Models\NotificationDraft;
use App\Models\NotificationSchedule;
use Illuminate\Support\Facades\File;
use App\Http\Requests\NotificationRequest;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationScheduleRepository;

class NotificationService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;

    /**
     * @var $NotificationDraftRepository
     */
    protected $notificationDraftRepository;
    /**
     * @var NotificationScheduleRepository
     */
    private $notificationScheduleRepository;

    /**
     * NotificationRepository constructor.
     * @param NotificationDraftRepository $notificationDraftRepository
     * @param NotificationRepository $notificationRepository
     * @param NotificationScheduleRepository $notificationScheduleRepository
     */
    public function __construct(
        NotificationDraftRepository $notificationDraftRepository,
        NotificationRepository $notificationRepository,
        NotificationScheduleRepository $notificationScheduleRepository
    ) {
        $this->notificationDraftRepository = $notificationDraftRepository;
        $this->setActionRepository($notificationDraftRepository);

        $this->notificationRepository = $notificationRepository;
        $this->notificationScheduleRepository = $notificationScheduleRepository;
    }

    /**
     * Storing the Notification resource
     * @param $data
     * @return Response
     */
    public function storeNotification(NotificationRequest $request)
    {
        $data = $request->all();
        
        $data['starts_at'] = $data['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');
        unset($data['display_period']);

        /* if ($request->hasFile('image')) {
             $file = $request->image;
             $path = $file->storeAs(
                 'notification/images',
                 strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                 'public'
             );
             $data['image'] = $path;
         } else {
             $data['image'] = null;
         }*/

        if (isset($data['image'])) {
            $data['image'] = 'storage/' . $data['image']->store('notification');

        }

        $data = $this->save($data);
        
        return new Response("Notification has been successfully created");
    
    }

    public function storeDuplicateNotification($data)
    {
        $data = $this->save($data);
        
        return new Response("Quick Notification has been successfully Duplicate");
    }

    public function storeQuickNotification($request)
    {
        $data = $request->all();
        $data['quick_notification'] = true;

        $data['starts_at'] = $data['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');
        unset($data['display_period']);

        /* if ($request->hasFile('image')) {
             $file = $request->image;
             $path = $file->storeAs(
                 'notification/images',
                 strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                 'public'
             );
             $data['image'] = $path;
         } else {
             $data['image'] = null;
         }*/

        if (isset($data['image'])) {
            $data['image'] = 'storage/' . $data['image']->store('notification');

        }

        $data = $this->save($data);
        
        return $data;
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateNotification($request, $id)
    {
        $data = $request->all();
        $notification = $this->findOne($id);

        /* if ($request->hasFile('image')) {
             $file = $request->image;
             $path = $file->storeAs(
                 'notification/images',
                 strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                 'public'
             );
             $data['image'] = $path;
         } else {
             unset($data['image']);
         }*/

        if (isset($data['image'])) {
            $data['image'] = 'storage/' . $data['image']->store('notification');

            if (File::exists($notification->image)) {
                unlink($notification->image);
            }

        }

//        $date_range_array = explode('-', $request['display_period']);
//        $data['starts_at'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
//            ->toDateTimeString();
//        $data['expires_at'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
//            ->toDateTimeString();
        unset($data['display_period']);
        $data['starts_at'] = $data['expires_at'] = Carbon::now()->format('Y-m-d H:i:s');

        $notification->update($data);
        $schedule = $notification->schedule ?? null;
        if ($schedule && $schedule->status == 'active') {
            $payload = [
                'title' => $data['title'],
                'message' => $data['body'],
            ];

            NotificationSchedule::where('id', $schedule->id)->update($payload);
        }

        return Response('Notification has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNotification($id)
    {
        $notification = $this->findOne($id);
        $notification->delete();
        return Response('Notification has been successfully deleted');
    }


    /**
     * Attach Notification to user
     *
     * @param $notification_id
     * @param $user_phone
     * @return string
     */
    public function attachNotificationToUser($notification_id, $user_phone)
    {
        return $this->notificationRepository->attachmentNotificationToUser($notification_id, $user_phone);
    }


    /**
     * @param $category_id
     * @param $user_phone
     * @return array
     */
    public function checkMuteOfferForUser($category_id, $user_phone): array
    {
        return $this->notificationRepository->checkMuteOfferForUser($category_id, $user_phone);
    }


    /**
     * Notification Report
     *
     * @return mixed
     */
    public function getNotificationReport()
    {
        return $this->notificationRepository->getNotificationReport();
    }

    /**
     * Notification Report
     *
     * @return mixed
     * Ahsan Habib
     */
    public function getNotificationListReport($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $completedNotificationIds = $this->notificationScheduleRepository->getCompletedNotificationDraftIds();

        $notifications = $this->notificationDraftRepository->findAll();
        $completedNotifications = $notifications->whereIn('id', $completedNotificationIds)
            ->sortBy(function ($completedNotification) use ($completedNotificationIds) {
                return array_search($completedNotification->id, $completedNotificationIds);
            });
        $notCompletedNotifications = $notifications->whereNotIn('id', $completedNotificationIds);

        $builder = new NotificationDraft();
        $builder->orderBy('id', 'desc');

        if ($request->has('search') && !empty($request->get('search'))) {
            $input = $request->get('search');

            if (!empty($input['value'])) {
                $titel = $input['value'];
                $completedNotifications = $completedNotifications->filter(function ($item) use ($titel) {
                    return false !== stristr($item->title, $titel);
                });
                $notCompletedNotifications = $notCompletedNotifications->filter(function ($item) use ($titel) {
                    return false !== stristr($item->title, $titel);
                });
                $mergedNotifications = $completedNotifications->merge($notCompletedNotifications);
                $all_items_count = $mergedNotifications->count();
                $items = $mergedNotifications->slice((int)$start)->take((int)$length);
            } else {
                $mergedNotifications = $completedNotifications->merge($notCompletedNotifications);
                $all_items_count = $mergedNotifications->count();
                $items = $mergedNotifications->slice((int)$start)->take((int)$length);
            }
        }

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];
        $items->each(function ($item) use (&$response) {
            $starts_at = (!empty($item->starts_at)) ? date('d-M-Y h:i a', strtotime($item->starts_at)) : '';
            $countSend = $item->getNotification->count() . ' > ' . $item->getNotificationSuccessfullySend->count();
            $device_type = (!empty($item->device_type)) ? $item->device_type : 'All';
            $response['data'][] = [
                'titel' => $item->title,
                'body' => $item->body,
                'device_type' => ucwords($device_type),
                'starts_at' => $starts_at,
                'sends' => $countSend,
            ];
        });
        return $response;
    }

    /**
     * Notification target wise Report
     *
     * @return mixed
     */
    public function getNotificationTargetwiseReport($title)
    {
        return $this->notificationRepository->getNotificationTargetReport($title);
    }


    /**
     * @param string|null $category_id
     * @return array
     */
    public function getMuteUserPhoneList($category_id)
    {
        return $this->notificationRepository->getMuteUserPhoneList($category_id);
    }


    /**
     * @param $user_phone_num
     * @param array $mute_user_phone
     * @return mixed
     */
    public function removeMuteUserFromList($user_phone_num, array $mute_user_phone)
    {
        return $this->notificationRepository->removeMuteUserFromList($user_phone_num, $mute_user_phone);
    }

    public function getActiveProducts($request)
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);


        $products = $builder->whereHas(
            'details',
            function ($q) use ($request) {

                if ($request->has('productCode') && !empty($request->input('productCode'))) {
                    $productCode = trim($request->input('productCode'));
                    $q->where('product_code', 'like', "$productCode%");
                }
                $q->whereIn('content_type', ['data', 'voice', 'sms', 'mix']);
            }
        )->get();
        $data = [];
        foreach ($products as $product) {
            $data [] = [
                'id' => $product->details->product_code,
                'text' => $product->details->product_code . ' (' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return $data;
    }

    public function  findOneById($id){

        return $this->findOne($id);
    }
}
