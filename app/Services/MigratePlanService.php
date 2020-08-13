<?php

namespace App\Services;

use App\Repositories\MigratePlanRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use App\Repositories\StoreRepository;

class MigratePlanService
{
    use CrudTrait;


    /**
     * @var MigratePlanRepository
     */
    protected $migratePlanRepository;


    /**
     * MigratePlanService constructor.
     * @param MigratePlanRepository $migratePlanRepository
     */
    public function __construct(MigratePlanRepository $migratePlanRepository)
    {
        $this->migratePlanRepository = $migratePlanRepository;
        $this->setActionRepository($migratePlanRepository);

    }


    /**
     * Retrieve store list
     *
     * @return mixed
     */
    public function getMigratePlanListList()
    {
        return $this->migratePlanRepository->getMigratePlanListList();
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeMigratePlan($data)
    {

        $data['icon'] = 'storage/' . $data['icon']->store('store');
        $data['image_url'] = 'storage/' . $data['image_url']->store('store');

        $store =  $this->save($data);


        return new Response("Store has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateMigratePlan($data, $id)
    {
        $migratePlanRepository = $this->findOne($id);

        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('store');
            unlink($migratePlanRepository->icon);
        }

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('store');
            unlink($migratePlanRepository->image_url);
        }

        $migratePlanRepository->update($data);

        return Response('Store has been successfully updated');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteMigratePlan($id)
    {
        $migratePlanRepository = $this->findOne($id);
        $migratePlanRepository->delete();
        return Response('Store has been successfully deleted');
    }

    /**
     * @param $request
     * @return Response
     */
   /* public function tableSortable($request)
    {
        $this->migratePlanRepository->sortMyBlStoreList($request);
        return new Response('update successfully');
    }*/


}
