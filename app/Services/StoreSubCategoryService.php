<?php

namespace App\Services;


use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\StoreSubCategoryRepository;


class StoreSubCategoryService
{
    use CrudTrait;

    /**
     * @var StoreSubCategoryRepository
     */
    protected $storeSubCategoryRepository;

    /**
     * StoreSubCategoryService constructor.
     * @param StoreSubCategoryRepository $storeSubCategoryRepository
     */
    public function __construct(StoreSubCategoryRepository $storeSubCategoryRepository)
    {
        $this->storeSubCategoryRepository = $storeSubCategoryRepository;
        $this->setActionRepository($storeSubCategoryRepository);
    }

    /**
     * Storing the NotificationCategory resource
     * @return Response
     */
    public function storeStoreSubCategory($data)
    {
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name_en']));
        $this->save($data);
        return new Response("Notification Category has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateStoreSubCategory($data, $id)
    {
        $notificationCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name_en']));
        $notificationCategory->update($data);
        return Response('Notification Category has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteStoreSubCategory($id)
    {
        $notificationCategory = $this->findOne($id);
        $notificationCategory->delete();
        return Response('Notification Category has been successfully deleted');
    }
}
