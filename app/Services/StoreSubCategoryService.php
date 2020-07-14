<?php

namespace App\Services;


use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class StoreSubCategoryService
{
    use CrudTrait;

    /**
     * @var StoreSubCategoryService \
     */
    protected $storeSubCategoryRepository;


    /**
     * StoreSubCategoryService constructor.
     * @param StoreSubCategoryService $storeSubCategoryRepository
     */
    public function __construct(StoreSubCategoryService $storeSubCategoryRepository)
    {
        $this->storeSubCategoryRepository = $storeSubCategoryRepository;
        $this->setActionRepository($storeSubCategoryRepository);
    }

    /**
     * Storing the NotificationCategory resource
     * @return Response
     */
    public function storeNotificationCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        //dd($data);
        $this->save($data);
        return new Response("Notification Category has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateNotificationCategory($data, $id)
    {
        $notificationCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name']));
        $notificationCategory->update($data);
        return Response('Notification Category has been successfully updated');
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
        return Response('Notification Category has been successfully deleted');
    }
}
