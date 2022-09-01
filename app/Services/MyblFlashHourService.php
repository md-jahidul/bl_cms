<?php

namespace App\Services;

use App\Helpers\BaseMsisdnHelper;
use App\Models\ProductCore;
use App\Repositories\FlashHourPurchaseReportRepository;
use App\Repositories\MyBlFlashHourProductRepository;
use App\Repositories\MyBlFlashHourRepository;
use App\Repositories\ProductCoreRepository;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

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
     * @var ProductCoreRepository
     */
    private $productCoreRepository;

    protected const FLASH_HOUR_REDIS_KEY = "base_msisdn_";


    /**
     * MyblFlashHourService constructor.
     * @param MyBlFlashHourRepository $flashHourRepository
     */
    public function __construct(
        MyBlFlashHourRepository $flashHourRepository,
        MyBlFlashHourProductRepository $flashHourProductRepository,
        FlashHourPurchaseReportRepository $purchaseReportRepository,
        ProductCoreRepository $productCoreRepository
    ) {
        $this->flashHourRepository = $flashHourRepository;
        $this->flashHourProductRepository = $flashHourProductRepository;
        $this->purchaseReportRepository = $purchaseReportRepository;
        $this->productCoreRepository = $productCoreRepository;
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

    public function addRedisKey($baseGroupId, $endDate)
    {
        $dayDiff = Carbon::now()->diffInDays($endDate) ?: 1;
        $ttl = 60 * 60 * 24 * $dayDiff;
        return BaseMsisdnHelper::baseMsisdnAddInRedis($baseGroupId, $ttl);
    }

    /**
     * Storing the Store resource
     * @param $data
     * @return Response
     */
    public function storeCampaign($data, $reference_type)
    {
        try {
            DB::beginTransaction();
            $data['reference_type'] = $reference_type;
            $campaign = $this->save($data);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    if (!empty($product['thumbnail_img'])) {
                        $product['thumbnail_img'] = 'storage/' . $product['thumbnail_img']->store('mybl_campaign');
                    }
                    $productType = $this->productCoreRepository->getProductType($product['product_code']);
                    $product['product_type'] = $productType;
                    $product['flash_hour_id'] = $campaign->id;
                    $product['show_in_home'] = isset($product['show_in_home']) ? 1 : 0;
                    $product['status'] = $product['status'] ?? 0;
                    unset($product['product_id']);
                    $this->flashHourProductRepository->save($product);
                }
            }
            DB::commit();
            return new Response("Campaign has been successfully created");
        } catch (\Exception $exception) {
            DB::rollback();
            $error = "Campaign Create Failed!! <br><br>" . $exception->getMessage();
            return new Response($error);
        }
    }

    public function duplicateFlashHours($data, $reference_type)
    {
        $data['title'] = $data['title'] . ' Copy';
        unset($data['created_at']);
        unset($data['updated_at']);
        unset($data['id']);
        $data['start_date'] = null;
        $data['end_date']   = null;
        $data['status']     = 0;

        try {
            DB::beginTransaction();
            $data['reference_type'] = $reference_type;
            $campaign = $this->save($data);
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $product) {
                    if ($reference_type == "mybl_campaign" && !empty($product['thumbnail_img'])) {
                        $product['thumbnail_img'] = 'storage/' . $product['thumbnail_img']->store('mybl_campaign');
                    }
                    $productType                = $this->productCoreRepository->getProductType($product['product_code']);
                    $product['product_type']    = $productType;
                    $product['flash_hour_id']   = $campaign->id;
                    $product['show_in_home']    = isset($product['show_in_home']) ? 1 : 0;
                    $product['status']          = $product['status'] ?? 0;
                    $product['start_date']      = null;
                    $product['end_date']        = null;
                    unset($product['id']);
                    $this->flashHourProductRepository->save($product);
                }
            }
            DB::commit();
            return new Response("Campaign has been successfully Duplicated");
        } catch (\Exception $exception) {
            DB::rollback();
            $error = "Campaign Create Failed!! <br><br>" . $exception->getMessage();
            return new Response($error);
        }
    }

    /**
     * Updating the Store
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateCampaign($data, $id)
    {
        try {
            DB::beginTransaction();
            $campaign = $this->findOne($id);
            $currentProductId = [];
            if (isset($data['product-group'])) {
                foreach ($data['product-group'] as $productData) {
                    $currentProductId[] = $productData['product_id'];
                    $product = $this->flashHourProductRepository->findOne($productData['product_id']);
                    $productType = $this->productCoreRepository->getProductType($productData['product_code']);
                    if (isset($productData['thumbnail_img'])) {
                        $productData['thumbnail_img'] = 'storage/' . $productData['thumbnail_img']->store('mybl_campaign');
                        if (!empty($product->thumbnail_img)) {
                            if (File::exists($product->thumbnail_img)) {
                                unlink($product->thumbnail_img);
                            }
                        }
                    }
                    $productData['show_in_home'] = isset($productData['show_in_home']) ? 1 : 0;
                    $productData['product_type'] = $productType;
                    $productData['flash_hour_id'] = $id;
                    $productData['status'] = $productData['status'] ?? 0;
                    unset($productData['product_id']);
                    if ($product) {
                        $product->update($productData);
                    } else {
                        $this->flashHourProductRepository->save($productData);
                    }
                }
            }

            $productIds = isset($data['old_product_id']) ? array_diff($data['old_product_id'], $currentProductId) : [];
            if (!empty($productIds)) {
                $this->flashHourProductRepository->deleteProduct(array_values($productIds));
            }

            $campaign->update($data);
            DB::commit();
            return Response('Campaign has been successfully updated');
        } catch (\Exception $exception) {
            DB::rollback();
            $error = "Campaign Update Failed!! <br><br>" . $exception->getMessage();
            return new Response($error);
        }
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteCampaign($id)
    {
        $campaign = $this->findOne($id);
        $this->purchaseReportRepository->deleteAllPurchaseReport($id);
        $campaign->delete();
        return Response('Campaign has been successfully deleted');
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
            $total_success = $this->purchaseStatusCount($purchaseCode, 'action_type', 'buy_success');
            $total_failed = $this->purchaseStatusCount($purchaseCode, 'action_type', 'buy_failure');

            $purchaseCodes[$key]['total_success'] = $total_success;
            $purchaseCodes[$key]['total_failed'] = $total_failed;
        }
        return $purchaseCodes;
    }

    public function msisdnPurchaseDetails($request, $id)
    {
        return $this->flashHourRepository->msisdnInfo($request, $id);
    }

    public function findById($id){
        return $this->flashHourRepository->findOne($id);
    }
}
