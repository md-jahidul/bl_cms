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
        $data['icon'] = 'storage/' . $data['icon']->store('subCategory');
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
        $subCategory = $this->findOne($id);
        $data['slug'] =  str_replace(" ", "_", strtolower($data['name_en']));

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('subCategory');
            unlink($subCategory->icon);
        }

        $subCategory->update($data);
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


    /**
     * @param $id
     * @return StoreSubCategoryRepository|\Illuminate\Support\Collection|null
     */
    public function getSubCategoryByCatId($id)
    {
        return $this->storeSubCategoryRepository->findByProperties(['category_id' => $id], ['id', 'name_en']);
    }
}
