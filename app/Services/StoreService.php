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
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeMyBlStore($data)
    {
        $this->save($data);
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
        $storeRepository = $this->findOne($id);
        $storeRepository->update($data);
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


}
