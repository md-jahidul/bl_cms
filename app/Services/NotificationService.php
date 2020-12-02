<?php

namespace App\Services;

use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\File;

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
     * NotificationRepository constructor.
     * @param NotificationDraftRepository $notificationDraftRepository
     */
    public function __construct(NotificationDraftRepository $notificationDraftRepository, NotificationRepository $notificationRepository)
    {
        $this->notificationDraftRepository = $notificationDraftRepository;
        $this->setActionRepository($notificationDraftRepository);

        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Storing the Notification resource
     * @param $data
     * @return Response
     */
    public function storeNotification(NotificationRequest $request)
    {
        $data = $request->all();

        $date_range_array = explode('-', $request['display_period']);
        $data['starts_at'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
            ->toDateTimeString();
        $data['expires_at'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
            ->toDateTimeString();
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


        $this->save($data);
        return new Response("Notification has been successfully created");
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
     */
    public function getNotificationListReport()
    {
        $orderBy = ['column' => "id", 'direction' => 'desc'];
        return $result=$this->notificationDraftRepository->findAll('', '', $orderBy);
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
}
