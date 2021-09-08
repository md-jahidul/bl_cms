<?php

namespace App\Services;

use App\Models\ProductCore;
use App\Repositories\FlashHourPurchaseReportRepository;
use App\Repositories\MyBlFlashHourProductRepository;
use App\Repositories\MyBlFlashHourRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblFlashHourService
{
    use CrudTrait;

    /**
     * @var MyBlFlashHourRepository
     */
    private $flashHourRepository;
    /**
     * @var MyBlFlashHourProductRepository
     */
    private $flashHourProductRepository;
    /**
     * @var FlashHourPurchaseReportRepository
     */
    private $purchaseReportRepository;


    /**
     * MyblFlashHourService constructor.
     * @param MyBlFlashHourRepository $flashHourRepository
     */
    public function __construct(
        MyBlFlashHourRepository $flashHourRepository,
        MyBlFlashHourProductRepository $flashHourProductRepository,
        FlashHourPurchaseReportRepository $purchaseReportRepository
    ) {
        $this->flashHourRepository = $flashHourRepository;
        $this->flashHourProductRepository = $flashHourProductRepository;
        $this->purchaseReportRepository = $purchaseReportRepository;
        $this->setActionRepository($flashHourRepository);
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
        $this->flashHourRepository->inactiveOldCampaign();
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
        $this->flashHourRepository->inactiveOldCampaign();
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

    public function purchaseStatusCount($campaign, $column, $colValue)
    {
        return collect($campaign->purchaseMsisdns)->sum(function ($data) use ($column, $colValue) {
            if ($data->{$column} == $colValue) {
                return true;
            }
            return false;
        });
    }

    public function analyticsData($date, $campaignId)
    {
        $purchaseCodes = $this->purchaseReportRepository->purchaseCodeWithMsisdn($date, $campaignId);
        foreach ($purchaseCodes as $key => $purchaseCode) {
            $total_success = $this->purchaseStatusCount($purchaseCode, 'action_type', 'success');
            $total_failed = $this->purchaseStatusCount($purchaseCode, 'action_type', 'failed');

            $purchaseCodes[$key]['total_success'] = $total_success;
            $purchaseCodes[$key]['total_failed'] = $total_failed;
        }
        return $purchaseCodes;
    }

    public function msisdnPurchaseDetails($request, $id)
    {
        return $this->flashHourRepository->msisdnInfo($request, $id);
    }
}
