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
        $this->save($data);
        return new Response("Refer and earn campaign has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateCampaign($data, $id)
    {
        $referAndEarn = $this->findOne($id);
        if (isset($data['icon'])) {
            $data['icon'] = 'storage/' . $data['icon']->store('refer_and_earn');

//            if ($referAndEarn->icon) {
//                unlink($referAndEarn->icon);
//            }
        }
        $data['referrer_product_code'] = str_replace(' ', '', strtoupper($data['referrer_product_code']));
        $data['referee_product_code'] = str_replace(' ', '', strtoupper($data['referee_product_code']));
        $referAndEarn->update($data);
        return Response('Refer and earn campaign has been successfully updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        $referAndEarn = $this->findOne($id);
        $referAndEarn->delete();
        return Response('Refer and earn campaign has been successfully deleted');
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

    public function analyticsData()
    {

    }

}
