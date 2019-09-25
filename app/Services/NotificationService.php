<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

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
        return new Response("Notification has successfully been created");
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
        return Response('Notification updated successfully !');
        
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
        return Response('Notification deleted successfully !');
    }

}
