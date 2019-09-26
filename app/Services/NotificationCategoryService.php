<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\NotificationCategoryRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;


class NotificationCategoryService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $notificationCategoryRepository;

    /**
     * DigitalServicesService constructor.
     * @param NotificationCategoryRepository $sliderRepository
     */
    public function __construct(NotificationCategoryRepository $notificationCategoryRepository)
    {
        $this->notificationCategoryRepository = $notificationCategoryRepository;
        $this->setActionRepository($notificationCategoryRepository);
    }

    /**
     * Storing the NotificationCategory resource
     * @return Response
     */
    public function storeNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ","_",strtolower($data['name']));
        //dd($data);
        $this->save($data);
        return new Response("Notification Category has successfully been created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateNotificationCategory($data, $id)
    {
        $notificationCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ","_",strtolower($data['name']));
        $notificationCategory->update($data);
        return Response('Notification Category updated successfully !');
        
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteNotificationCategory($id)
    {
        $notificationCategory = $this->findOne($id);
        $notificationCategory->delete();
        return Response('Notification Category deleted successfully !');
    }

}
