<?php

namespace App\Services;

use App\Repositories\NotificationDraftRepository;
use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class NotificationService
{
    use CrudTrait;



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
     * @return Response
     */
    public function storeNotification($data)
    {
        $this->save($data);
        return new Response("Notification has been successfully created");
    }

    /**
     * Updating the Notification
     * @param $data
     * @return Response
     */
    public function updateNotification($data, $id)
    {
        $notification = $this->findOne($id);
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
}
