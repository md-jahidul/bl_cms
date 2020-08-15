<?php

namespace App\Services;

use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\StoreRepository;

class StoreService
{
    use CrudTrait;

    /**
     * @var StoreRepository
     */
    protected $storeRepository;

    /**
     * StoreService constructor.
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->setActionRepository($storeRepository);

    }


    /**
     * Retrieve store list
     *
     * @return mixed
     */
    public function getMyBlStorList()
    {
        return $this->storeRepository->getMyBlStoreList();
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeMyBlStore($data)
    {
        if(isset($data['app_id'])){
            $app_ids = $data['app_id'];
            unset($data['app_id']);
        }

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('store');
        }

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('store');
        }

       $store =  $this->save($data);

        if(isset($data['app_id'])){
            $store->apps()->attach($app_ids);
        }

        return new Response("Store has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateStore($data, $id)
    {

        $app_ids = $data['app_id'];
        unset($data['app_id']);

        $storeRepository = $this->findOne($id);

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('store');
            unlink($storeRepository->icon);
        }

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('store');
            unlink($storeRepository->image_url);
        }

        $storeRepository->update($data);

        $storeRepository->apps()->sync($app_ids);

        return Response('Store has been successfully updated');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteStore($id)
    {
        $storeRepository = $this->findOne($id);
        $storeRepository->delete();
        return Response('Store has been successfully deleted');
    }

    /**
     * @param $request
     * @return Response
     */
    public function tableSortable($request)
    {
        $this->storeRepository->sortMyBlStoreList($request);
        return new Response('update successfully');
    }


}
