<?php
namespace App\Services;


use App\Repositories\NotificationRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class NotificationService
{

    use CrudTrait;
    /**
     * @var $NotificationRepository
     */
    protected $notificationRepository;

    /**
     * NotificationRepository constructor.
     * @param NotificationRepository $notificationRepository
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->setActionRepository($notificationRepository);
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

}
