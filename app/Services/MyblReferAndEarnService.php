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
        $referAndEarns = $this->referAndEarnRepository->referAndEarnData();
        foreach ($referAndEarns as $key => $referAndEarn) {
            $total_referees = $referAndEarn->referrers->sum('referees_count');
            $total_success = collect($referAndEarn->referrers)->sum(function ($data) {
                return $data->referees->sum(function ($value) {
                    if ($value->status == 'redeemed') {
                        return true;
                    }
                    return false;
                });
            });
            $referAndEarns[$key]['total_referees'] = $total_referees;
            $referAndEarns[$key]['total_success'] = $total_success;
        }
        return $referAndEarns;
    }

    public function detailsCampaign($id)
    {
        $referAndEarn = $this->referAndEarnRepository->referAndEarnData($id);
//        return $referAndEarns;
//        dd($referAndEarns);
//        foreach ($referAndEarns as $key => $referAndEarn) {
            $total_referees = $referAndEarn->referrers->sum('referees_count');
            $total_success = collect($referAndEarn->referrers)->sum(function ($data) {
                return $data->referees->sum(function ($value) {
                    if ($value->status == 'redeemed') {
                        return true;
                    }
                    return false;
                });
            });
            $referAndEarn['total_referees'] = $total_referees;
            $referAndEarn['total_success'] = $total_success;
//        }
        return $referAndEarn;
//        dd('ggg');
    }

    public function refereeDetails($request, $id)
    {
        return $this->referAndEarnRepository->refereeInfo($request, $id);
    }

}
