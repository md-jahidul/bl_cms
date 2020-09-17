<?php

namespace App\Services;

use App\Repositories\StoreAppRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\StoreRepository;

/**
 * Class StoreAppService
 * @package App\Services
 */
class StoreAppService
{
    use CrudTrait;


    /**
     * @var StoreAppRepository
     */
    protected $storeAppRepository;

    /**
     * StoreService constructor.
     * @param StoreAppRepository $storeAppRepository
     */
    public function __construct(StoreAppRepository $storeAppRepository)
    {
        $this->storeAppRepository = $storeAppRepository;
        $this->setActionRepository($storeAppRepository);

    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeMyBlAppStore($data)
    {
        if(isset($data['store_id'])){
            $store_ids = $data['store_id'];
            unset($data['store_id']);
        }

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('app');
        }

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('app');
        }

        $store_apps = $this->save($data);

        if(isset($data['store_id'])){
            $store_apps->stores()->attach($store_ids);
        }

        return new Response("App has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateStore($data, $id)
    {
        if(isset($data['store_id'])){
            $store_ids = $data['store_id'];
            unset($data['store_id']);
        }

        $storeAppRepository = $this->findOne($id);

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('app');
            unlink($storeAppRepository->icon);
        }

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('app');
            unlink($storeAppRepository->image_url);
        }

        $storeAppRepository->update($data);

        if(isset($data['store_id'])){
            $storeAppRepository->stores()->sync($store_ids);
        }
        return Response('App has been successfully updated');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteStore($id)
    {
        $storeAppRepository = $this->findOne($id);
        $storeAppRepository->delete();
        return Response('App has been successfully deleted');
    }

}
