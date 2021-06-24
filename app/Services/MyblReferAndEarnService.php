<?php

namespace App\Services;

use App\Models\ProductCore;
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

    public function campaignStatus($referAndEarn, $status)
    {
        return collect($referAndEarn->referrers)->sum(function ($data) use ($status) {
            return $data->referees->sum(function ($value) use ($status) {
                if ($value->status == $status) {
                    return true;
                }
                return false;
            });
        });
    }

    public function referrersStatus($referAndEarn, $status)
    {
        return collect($referAndEarn->referees)->sum(function ($data) use ($status) {
            if ($data->status == $status) {
                return true;
            }
            return false;
        });
    }

    public function analyticsData()
    {
        $referAndEarns = $this->referAndEarnRepository->referAndEarnData();
        foreach ($referAndEarns as $key => $referAndEarn) {
            $total_referrers = $referAndEarn->referrers->count();
            $total_referees = $referAndEarn->referrers->sum('referees_count');

            $total_success = $this->campaignStatus($referAndEarn, 'redeemed');
            $total_claimed = $this->campaignStatus($referAndEarn, 'claimed');

            $referAndEarns[$key]['total_referrers'] = $total_referrers;
            $referAndEarns[$key]['total_referees'] = $total_referees;
            $referAndEarns[$key]['total_success'] = $total_success;
            $referAndEarns[$key]['total_claimed'] = $total_claimed;
        }
        return $referAndEarns;
    }

    public function detailsCampaign($request, $id)
    {
        $referAndEarn = $this->referAndEarnRepository->referAndEarnData($request, $id);

        $referrerData = ProductCore::where('product_code', $referAndEarn->referrer_product_code)
            ->select('product_code', 'data_volume', 'data_volume_unit')
            ->first();
        $refereesData = ProductCore::where('product_code', $referAndEarn->referee_product_code)
            ->select('product_code', 'data_volume', 'data_volume_unit')
            ->first();

        $referAndEarn['referrer_data'] = isset($referrerData) ? "$referrerData->data_volume $referrerData->data_volume_unit" : 'Product Not found';;
        $referAndEarn['referee_data'] = isset($refereesData) ? "$refereesData->data_volume $refereesData->data_volume_unit" : 'Product Not found';

        $total_referrers = $referAndEarn->referrers->count();
        $total_referees = $referAndEarn->referrers->sum('referees_count');
        $total_success = $this->campaignStatus($referAndEarn, 'redeemed');
        $total_claimed = $this->campaignStatus($referAndEarn, 'claimed');

        $referAndEarn['total_referrers'] = $total_referrers;
        $referAndEarn['total_referees'] = $total_referees;
        $referAndEarn['total_success'] = $total_success;
        $referAndEarn['total_claimed'] = $total_claimed;

        $referrers = [];
        foreach ($referAndEarn->referrers as $referrer) {
            $totalRedeemed = $this->referrersStatus($referrer, 'redeemed');
            $totalClaimed = $this->referrersStatus($referrer, 'claimed');
            $totalInvited = $this->referrersStatus($referrer, 'invited');
            $referrers[] = [
                'id' => $referrer->id,
                'referral_code' => $referrer->referral_code,
                'refer_and_earn_id' => $referrer->refer_and_earn_id,
                'msisdn' => $referrer->msisdn,
                'total_redeemed' => $totalRedeemed + $totalClaimed,
                'total_claimed' => $totalClaimed,
                'total_invited' => $totalInvited
            ];
        }
        $referAndEarn['referrers_info'] = $referrers;
        unset($referAndEarn['referrers']);
        return $referAndEarn;
    }

    public function refereeDetails($request, $id)
    {
        return $this->referAndEarnRepository->refereeInfo($request, $id);
    }
}
