<?php

namespace App\Services;

use App\Repositories\MyBlReferAndEarnRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class MyblReferAndEarnService
{
    use CrudTrait;

    /**
     * @var MyBlReferAndEarnRepository
     */
    private $referAndEarnRepository;


    /**
     * MyblReferAndEarnService constructor.
     * @param MyBlReferAndEarnRepository $referAndEarnRepository
     */
    public function __construct(MyBlReferAndEarnRepository $referAndEarnRepository)
    {
        $this->referAndEarnRepository = $referAndEarnRepository;
        $this->setActionRepository($referAndEarnRepository);
    }


    /**
     * Retrieve store list
     *
     * @return mixed
     */
    public function getReferEarnCampaignList()
    {
        return $this->referAndEarnRepository->getMigratePlanListList();
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data)
    {

        if (!empty($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('refer_and_earn');
        }
        $data['referrer_product_code'] = str_replace(' ', '', strtoupper($data['referrer_product_code']));
        $data['referee_product_code'] = str_replace(' ', '', strtoupper($data['referee_product_code']));

//        dd($data);

        $this->save($data);


        return new Response("Refer and earn camping has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateMigratePlan($data, $id)
    {
        $referAndEarnRepository = $this->findOne($id);

        if (isset($data['image_url'])) {
            $data['image_url'] = 'storage/' . $data['image_url']->store('plan');
            unlink($referAndEarnRepository->image_url);
        }

        $referAndEarnRepository->update($data);

        return Response('Migrate Plan has been successfully updated');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteMigratePlan($id)
    {
        $referAndEarnRepository = $this->findOne($id);
        $referAndEarnRepository->delete();
        return Response('Migrate Plan has been successfully deleted');
    }

    /**
     * @param $request
     * @return Response
     */
   /* public function tableSortable($request)
    {
        $this->referAndEarnRepository->sortMyBlStoreList($request);
        return new Response('update successfully');
    }*/


}
