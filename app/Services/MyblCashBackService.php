<?php

namespace App\Services;

use App\Models\ProductCore;
use App\Repositories\MyblCashBackRepository;
use App\Repositories\MyBlFlashHourProductRepository;
use App\Repositories\MyBlFlashHourRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblCashBackService
{
    use CrudTrait;

    /**
     * @var MyblCashBackRepository
     */
    private $cashBackRepository;

    /**
     * MyblCashBackService constructor.
     * @param MyblCashBackRepository $cashBackRepository
     */
    public function __construct(
        MyblCashBackRepository $cashBackRepository
    ) {
        $this->cashBackRepository = $cashBackRepository;
        $this->setActionRepository($cashBackRepository);
    }


    /**
     * Retrieve store list
     *
     * @return mixed
     */
    public function getReferEarnCampaignList()
    {
        return $this->flashHourRepository->getMigratePlanListList();
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data)
    {
        $campaign = $this->save($data);
        if (isset($data['product-group'])) {
            foreach ($data['product-group'] as $product) {
                $product['flash_hour_id'] = $campaign->id;
                $this->flashHourProductRepository->save($product);
            }
        }
        return new Response("Flash hour campaign has been successfully created");
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateCampaign($data, $id)
    {
        $campaign = $this->findOne($id);
        $this->flashHourProductRepository->deleteCampaignWiseProduct($id);
        if (isset($data['product-group'])) {
            foreach ($data['product-group'] as $product) {
                $product['flash_hour_id'] = $id;
                $this->flashHourProductRepository->save($product);
            }
        }
        $campaign->update($data);
        return Response('Flash hour campaign has been successfully updated');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        $campaign = $this->findOne($id);
        $campaign->delete();
        return Response('Flash hour campaign has been successfully deleted');
    }

    public function campaignStatus($campaign, $column, $colValue)
    {
        return collect($campaign->referrers)->sum(function ($data) use ($column, $colValue) {
            return $data->referees->sum(function ($value) use ($column, $colValue) {
                if ($value->{$column} == $colValue) {
                    return true;
                }
                return false;
            });
        });
    }

    public function referrersStatus($campaign, $column, $value)
    {
        return collect($campaign->referees)->sum(function ($data) use ($column, $value) {
            if ($data->{$column} == $value) {
                return true;
            }
            return false;
        });
    }

    public function analyticsData()
    {
        $campaigns = $this->flashHourRepository->referAndEarnData();
        foreach ($campaigns as $key => $campaign) {
            $total_referrers = $campaign->referrers->count();
            $total_referees = $campaign->referrers->sum('referees_count');

            $total_success = $this->campaignStatus($campaign, 'status', 'redeemed');
            $total_claimed = $this->campaignStatus($campaign, 'status', 'claimed');
            $total_invited = $this->campaignStatus($campaign, 'is_invited', 1);

            $campaigns[$key]['total_referrers'] = $total_referrers;
            $campaigns[$key]['total_referees'] = $total_referees;
            $campaigns[$key]['total_success'] = $total_success;
            $campaigns[$key]['total_claimed'] = $total_claimed;
            $campaigns[$key]['total_invited'] = $total_invited;
        }
        return $campaigns;
    }

    public function detailsCampaign($request, $id)
    {
        $campaign = $this->flashHourRepository->referAndEarnData($request, $id);
        $referrerData = ProductCore::where('product_code', $campaign->referrer_product_code)
            ->select('product_code', 'data_volume', 'data_volume_unit')
            ->first();
        $refereesData = ProductCore::where('product_code', $campaign->referee_product_code)
            ->select('product_code', 'data_volume', 'data_volume_unit')
            ->first();

        $campaign['referrer_data'] = isset($referrerData) ? "$referrerData->data_volume $referrerData->data_volume_unit" : 'Product Not found';;
        $campaign['referee_data'] = isset($refereesData) ? "$refereesData->data_volume $refereesData->data_volume_unit" : 'Product Not found';

        $total_referrers = $campaign->referrers->count();
        $total_referees = $campaign->referrers->sum('referees_count');
        $total_success = $this->campaignStatus($campaign, 'status', 'redeemed');
        $total_claimed = $this->campaignStatus($campaign, 'status', 'claimed');
        $total_invited = $this->campaignStatus($campaign, 'is_invited', 1);

        $campaign['total_referrers'] = $total_referrers;
        $campaign['total_referees'] = $total_referees;
        $campaign['total_success'] = $total_success;
        $campaign['total_claimed'] = $total_claimed;
        $campaign['total_invited'] = $total_invited;

        $referrers = [];
        foreach ($campaign->referrers as $referrer) {
            $totalRedeemed = $this->referrersStatus($referrer, 'status', 'redeemed');
            $totalClaimed = $this->referrersStatus($referrer, 'status', 'claimed');
            $totalInvited = $this->referrersStatus($referrer, 'is_invited', 1);
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
        $campaign['referrers_info'] = $referrers;
        unset($campaign['referrers']);
        return $campaign;
    }

    public function refereeDetails($request, $id)
    {
        return $this->flashHourRepository->refereeInfo($request, $id);
    }
}
