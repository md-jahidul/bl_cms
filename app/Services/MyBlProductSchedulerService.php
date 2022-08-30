<?php

namespace App\Services;

use App\Models\MyBlProduct;
use App\Models\MyBlProductTab;
use App\Models\ProductCore;
use App\Models\ProductCoreHistory;
use App\Repositories\CustomerRepository;
use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyBlProductRepository;
use App\Repositories\MyBlProductSchedulerRepository;
use App\Services\BlApiHub\BaseService;
use App\Traits\CrudTrait;
use App\Models\NotificationDraft;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class BannerService
 * @package App\Services
 */
class MyBlProductSchedulerService
{
    use CrudTrait;

    private $myblProductScheduleRepository, $myblProductRepository;

    public function __construct(MyBlProductSchedulerRepository $myblProductScheduleRepository, MyBlProductRepository $myBlProductRepository)
    {
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
        $this->myblProductRepository = $myBlProductRepository;
    }

    public function productSchedule()
    {
        $currentTime = Carbon::parse()->format('Y-m-d H:i:s');
        $products = $this->myblProductRepository->findAll();

        foreach ($products as $product) {

            $productSchedule = $this->myblProductScheduleRepository->findScheduleDataByProductCode($product['product_code']);

            if(is_null($productSchedule)) {
                continue;
            }

            if ($currentTime >= $productSchedule['start_date'] && $currentTime <= $productSchedule['end_date'] && $productSchedule['change_state_status'] == 0) {

                $productData = [];
                $productScheduleData = [];
                if ($product->is_banner_schedule) {
                    $productData['media'] = $productSchedule['media'];
                    $productScheduleData['media'] = $product['media'];
                }

                if ($product->is_tags_schedule) {
                    //TODO
                }

                if ($product->is_visible_schedule) {
                    $productData['is_visible'] = $productSchedule['is_visible'];
                    $productScheduleData['is_visible'] = $product['is_visible'];
                }

                if ($product->is_pin_to_top_schedule) {
                    $productData['pin_to_top'] = $productSchedule['pin_to_top'];
                    $productScheduleData['pin_to_top'] = $product['pin_to_top'];
                }

                if ($product->is_base_msisdn_group_id_schedule) {
                    $productData['base_msisdn_group_id'] = $productSchedule['base_msisdn_group_id'];
                    $productScheduleData['base_msisdn_group_id'] = $product['base_msisdn_group_id'];
                }
                $productScheduleData['change_state_status'] = 1;

                try {

                    DB::beginTransaction();

                    $this->myblProductRepository->updateDataById($product['id'], $productData);
                    $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollback();
                    Log::info($e->getMessage());
                }
            } elseif ($currentTime > $productSchedule['end_date'] && $productSchedule['change_state_status'] == 1) {
                $productData = [];
                $productScheduleData = [];
                if ($product->is_banner_schedule) {
                    $productData['media'] = $productSchedule['media'];
                    $productScheduleData['media'] = $product['media'];
                }

                if ($product->is_tags_schedule) {
                    //TODO
                }

                if ($product->is_visible_schedule) {
                    $productData['is_visible'] = $productSchedule['is_visible'];
                    $productScheduleData['is_visible'] = $product['is_visible'];
                }

                if ($product->is_pin_to_top_schedule) {
                    $productData['pin_to_top'] = $productSchedule['pin_to_top'];
                    $productScheduleData['pin_to_top'] = $product['pin_to_top'];
                }

                if ($product->is_base_msisdn_group_id_schedule) {
                    $productData['base_msisdn_group_id'] = $productSchedule['base_msisdn_group_id'];
                    $productScheduleData['base_msisdn_group_id'] = $product['base_msisdn_group_id'];
                }
                $productScheduleData['change_state_status'] = 0;

                try {
                    DB::beginTransaction();

                    $this->myblProductRepository->updateDataById($product['id'], $productData);
                    $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollback();
                    Log::info($e->getMessage());
                }
            }
        }
    }
}
