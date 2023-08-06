<?php

namespace App\Services;

use App\Models\MyBlProduct;
use App\Models\MyBlProductTab;
use App\Models\ProductCore;
use App\Models\ProductCoreHistory;
use App\Models\ProductTag;
use App\Repositories\CustomerRepository;
use App\Repositories\MyblCashBackProductRepository;
use App\Repositories\MyBlProductRepository;
use App\Repositories\MyBlProductSchedulerRepository;
use App\Repositories\MyBlProductTagRepository;
use App\Repositories\ProductCoreRepository;
use App\Services\BlApiHub\BaseService;
use App\Traits\CrudTrait;
use App\Models\NotificationDraft;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/**
 * Class BannerService
 * @package App\Services
 */
class MyBlProductSchedulerService
{
    use CrudTrait;

    private $myblProductScheduleRepository, $myblProductRepository, $myblProductTagRepository;
    private $productCoreRepository;

    public function __construct(
        MyBlProductSchedulerRepository $myblProductScheduleRepository,
        MyBlProductRepository $myBlProductRepository,
        MyBlProductTagRepository $myBlProductTagRepository,
        ProductCoreRepository  $productCoreRepository
    ) {
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
        $this->myblProductRepository = $myBlProductRepository;
        $this->myblProductTagRepository = $myBlProductTagRepository;
        $this->productCoreRepository = $productCoreRepository;
    }

    protected function removeRedisKeyByBaseGroupId()
    {
        if (isset($productSchedule) && !empty($productSchedule->base_msisdn_group_id)) {
            $redisKeys = Redis::keys('*my_key*');

            if ( !empty( $redisKeys ) ){
                $redisKeys = array_map(function ($redisKeys){
                    return str_replace(env('REDIS_PREFIX') . '_database_', '', $redisKeys);
                }, $redisKeys);
                Redis::del($redisKeys);
            }
        }
    }

    public function productSchedule()
    {
        $currentTime = Carbon::parse()->format('Y-m-d H:i:s');
        $products = $this->myblProductRepository->findScheduleProductList();
        $productCore = $this->productCoreRepository->findScheduleProductList();

        foreach ($products as $product) {

            $productSchedule = $this->myblProductScheduleRepository->findScheduleDataByProductCode($product['product_code']);

            $this->removeRedisKeyByBaseGroupId($productSchedule);

            if(is_null($productSchedule)) {
                continue;
            }

            if ($currentTime >= $productSchedule['start_date'] && $currentTime < $productSchedule['end_date'] && $productSchedule['change_state_status'] == 0) {

                $productData = [];
                $productScheduleData = [];
                if ($product->is_banner_schedule) {
                    $productData['media'] = $productSchedule['media'];
                    $productScheduleData['media'] = $product['media'];
                }

                if ($product->is_tags_schedule) {
                    $productTags = $this->myblProductTagRepository->findTagIdByProductCode($product['product_code']);

                    $productScheduleData['tags'] = null;
                    $productData['tag'] = null;
                    if(!$productTags->isEmpty()) {
                        $productScheduleData['tags'] = $productTags;
                        $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
                    }
                    if ($productScheduleData['tags'] != null && $productSchedule->tags != null) {

                        $firstTag = ProductTag::where('id', json_decode($productSchedule->tags)[0])->first();
                        $tag = $firstTag->title;
                        $productData['tag'] = $tag;
                        $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
                        $tags = [];
                        foreach (json_decode($productSchedule->tags) as $productScheduleTag) {

                            $data['product_code'] = $product['product_code'];
                            $data['product_tag_id'] = $productScheduleTag;

                            $tags [] = $data;
                        }
                        $this->myblProductTagRepository->insert($tags);
                    } else {
                        if (isset(($productSchedule->tags)[0])) {
                            $firstTag = ProductTag::where('id', json_decode($productSchedule->tags)[0])->first();
                            $tag = $firstTag->title;
                            $productData['tag'] = $tag;
                            $tags = [];

                            foreach (json_decode($productSchedule->tags) as $productScheduleTag) {

                                $data['product_code'] = $product['product_code'];
                                $data['product_tag_id'] = $productScheduleTag;

                                $tags [] = $data;
                            }

                            $this->myblProductTagRepository->insert($tags);
                        }
                    }
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
                Redis::del('prepaid_popular_pack');
                Redis::del('postpaid_popular_pack');
            } elseif ($currentTime >= $productSchedule['end_date'] && $productSchedule['change_state_status'] == 1) {

                $productData = [];
                $productScheduleData = [];
                if ($product->is_banner_schedule) {
                    $productData['media'] = $productSchedule['media'];
                    $productScheduleData['media'] = $product['media'];
                }

                if ($product->is_tags_schedule) {
                    //TODO : Need ProductTag Repository to get ProductTag Title
                    $productTags = $this->myblProductTagRepository->findTagIdByProductCode($product['product_code']);

                    $productScheduleData['tags'] = null;
                    $productData['tag'] = null;
                    if(!$productTags->isEmpty()) {
                        $productScheduleData['tags'] = $productTags;

                        $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
                    }

                    if ($productSchedule->tags != null) {
                        $firstTag = ProductTag::where('id', json_decode($productSchedule->tags)[0])->first();
                        $tag = $firstTag->title;
                        $productData['tag'] = $tag;

                        $tags = [];
                        foreach (json_decode($productSchedule->tags) as $productScheduleTag) {

                            $data['product_code'] = $product['product_code'];
                            $data['product_tag_id'] = $productScheduleTag;

                            $tags [] = $data;
                        }
                        $this->myblProductTagRepository->insert($tags);
                    }
                    else {
                        $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
                    }
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
                $productData['is_banner_schedule'] = 0;
                $productData['is_tags_schedule'] = 0;
                $productData['is_visible_schedule'] = 0;
                $productData['is_pin_to_top_schedule'] = 0;
                $productData['is_base_msisdn_group_id_schedule'] = 0;
                try {
                    DB::beginTransaction();

                    $this->myblProductRepository->updateDataById($product['id'], $productData);
                    $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollback();
                    Log::info($e->getMessage());
                }
                Redis::del('prepaid_popular_pack');
                Redis::del('postpaid_popular_pack');
            }
        }

        foreach ($productCore as $product) {

            $productSchedule = $this->myblProductScheduleRepository->findScheduleDataByProductCodeV2($product['product_code']);

            $this->removeRedisKeyByBaseGroupId($productSchedule);

            if(is_null($productSchedule)) {
                continue;
            }

            if ($currentTime >= $productSchedule['start_date'] && $currentTime <= $productSchedule['end_date'] && $productSchedule['product_core_change_state_status'] == 0) {

                $productData = [];
                $productScheduleData = [];

                if ($product->is_commercial_name_en_schedule) {
                    $productData['commercial_name_en'] = $productSchedule['commercial_name_en'];
                    $productScheduleData['commercial_name_en'] = $product['commercial_name_en'];
                }

                if ($product->is_commercial_name_bn_schedule) {
                    $productData['commercial_name_bn'] = $productSchedule['commercial_name_bn'];
                    $productScheduleData['commercial_name_bn'] = $product['commercial_name_bn'];
                }

                if ($product->is_display_title_en_schedule) {
                    $productData['display_title_en'] = $productSchedule['display_title_en'];
                    $productScheduleData['display_title_en'] = $product['display_title_en'];
                }
                if ($product->is_display_title_bn_schedule) {
                    $productData['display_title_bn'] = $productSchedule['display_title_bn'];
                    $productScheduleData['display_title_bn'] = $product['display_title_bn'];
                }
                $productScheduleData['product_core_change_state_status'] = 1;

                try {

                    DB::beginTransaction();

                    $this->productCoreRepository->updateDataById($product['id'], $productData);
                    $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollback();
                    Log::info($e->getMessage());
                }
                Redis::del('prepaid_popular_pack');
                Redis::del('postpaid_popular_pack');
            } elseif ($currentTime > $productSchedule['end_date'] && $productSchedule['product_core_change_state_status'] == 1) {

                $productData = [];
                $productScheduleData = [];

                if ($product->is_commercial_name_en_schedule) {
                    $productData['commercial_name_en'] = $productSchedule['commercial_name_en'];
                    $productScheduleData['commercial_name_en'] = $product['commercial_name_en'];
                }

                if ($product->is_commercial_name_bn_schedule) {
                    $productData['commercial_name_bn'] = $productSchedule['commercial_name_bn'];
                    $productScheduleData['commercial_name_bn'] = $product['commercial_name_bn'];
                }

                if ($product->is_display_title_en_schedule) {
                    $productData['display_title_en'] = $productSchedule['display_title_en'];
                    $productScheduleData['display_title_en'] = $product['display_title_en'];
                }

                if ($product->is_display_title_bn_schedule) {
                    $productData['display_title_bn'] = $productSchedule['display_title_bn'];
                    $productScheduleData['display_title_bn'] = $product['display_title_bn'];
                }

                $productScheduleData['product_core_change_state_status'] = 0;
                $productData['is_commercial_name_en_schedule'] = 0;
                $productData['is_commercial_name_bn_schedule'] = 0;
                $productData['is_display_title_en_schedule'] = 0;
                $productData['is_display_title_bn_schedule'] = 0;
                try {
                    DB::beginTransaction();

                    $this->productCoreRepository->updateDataById($product['id'], $productData);
                    $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollback();
                    Log::info($e->getMessage());
                }
                Redis::del('prepaid_popular_pack');
                Redis::del('postpaid_popular_pack');
            }
        }
    }

    public function cancelSchedule($id)
    {
        $productSchedule = $this->myblProductScheduleRepository->findOne($id);
        $product = ($this->myblProductRepository->findByProperties(['product_code' => $productSchedule->product_code], ['*']))->first();
        $productCore = ($this->productCoreRepository->findByProperties(['product_code' => $productSchedule->product_code], ['*']))->first();

        $productData = [];
        $productCoreData = [];
        $productScheduleData = [];

        if ($product->is_banner_schedule && $productSchedule->change_state_status) {
            $productData['media'] = $productSchedule['media'];
            $productScheduleData['media'] = $product['media'];
        }

        if ($product->is_tags_schedule && $productSchedule->change_state_status) {
            //TODO : Need ProductTag Repository to get ProductTag Title
            $productTags = $this->myblProductTagRepository->findTagIdByProductCode($product['product_code']);

            $productScheduleData['tags'] = null;
            $productData['tag'] = null;
            if(!$productTags->isEmpty()) {
                $productScheduleData['tags'] = $productTags;
            }
            if ($productScheduleData['tags'] != null && $productSchedule->tags != null) {
                $firstTag = ProductTag::where('id', json_decode($productSchedule->tags)[0])->first();
                $tag = $firstTag->title;
                $productData['tag'] = $tag;
                $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
                $tags = [];
                foreach (json_decode($productSchedule->tags) as $productScheduleTag) {

                    $data['product_code'] = $product['product_code'];
                    $data['product_tag_id'] = $productScheduleTag;

                    $tags [] = $data;
                }
                $this->myblProductTagRepository->insert($tags);
            } else {
                $this->myblProductTagRepository->deleteByProductCode($product['product_code']);
            }

        }

        if ($product->is_visible_schedule && $productSchedule->change_state_status) {
            $productData['is_visible'] = $productSchedule['is_visible'];
            $productScheduleData['is_visible'] = $product['is_visible'];
        }

        if ($product->is_pin_to_top_schedule && $productSchedule->change_state_status) {
            $productData['pin_to_top'] = $productSchedule['pin_to_top'];
            $productScheduleData['pin_to_top'] = $product['pin_to_top'];
        }

        if ($product->is_base_msisdn_group_id_schedule && $productSchedule->change_state_status) {
            $productData['base_msisdn_group_id'] = $productSchedule['base_msisdn_group_id'];
            $productScheduleData['base_msisdn_group_id'] = $product['base_msisdn_group_id'];
        }

        if ($productCore->is_commercial_name_en_schedule && $productSchedule->product_core_change_state_status) {
            $productCoreData['commercial_name_en'] = $productSchedule['commercial_name_en'];
            $productScheduleData['commercial_name_en'] = $productCore['commercial_name_en'];
        }

        if ($productCore->is_commercial_name_bn_schedule && $productSchedule->product_core_change_state_status) {
            $productCoreData['commercial_name_bn'] = $productSchedule['commercial_name_bn'];
            $productScheduleData['commercial_name_bn'] = $productCore['commercial_name_bn'];
        }

        if ($productCore->is_display_title_en_schedule && $productSchedule->product_core_change_state_status) {
            $productCoreData['display_title_en'] = $productSchedule['display_title_en'];
            $productScheduleData['display_title_en'] = $productCore['display_title_en'];
        }

        if ($productCore->is_display_title_bn_schedule && $productSchedule->product_core_change_state_status) {
            $productCoreData['display_title_bn'] = $productSchedule['display_title_bn'];
            $productScheduleData['display_title_bn'] = $productCore['display_title_bn'];
        }

        $productScheduleData['change_state_status'] = 0;
        $productScheduleData['product_core_change_state_status'] = 0;
        $productScheduleData['is_cancel'] = 1;

        $productData['is_banner_schedule'] = 0;
        $productData['is_tags_schedule'] = 0;
        $productData['is_visible_schedule'] = 0;
        $productData['is_pin_to_top_schedule'] = 0;
        $productData['is_base_msisdn_group_id_schedule'] = 0;

        $productCoreData['is_commercial_name_en_schedule'] = 0;
        $productCoreData['is_commercial_name_bn_schedule'] = 0;
        $productCoreData['is_display_title_en_schedule'] = 0;
        $productCoreData['is_display_title_bn_schedule'] = 0;
        try {
            DB::beginTransaction();

            $this->myblProductRepository->updateDataById($product['id'], $productData);
            $this->myblProductScheduleRepository->updateDataById($productSchedule['id'], $productScheduleData);
            $this->productCoreRepository->updateDataById($productCore['id'], $productCoreData);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            Log::info($e->getMessage());
        }
        Redis::del('prepaid_popular_pack');
        Redis::del('postpaid_popular_pack');
    }

    public function getTag($tagId) {

        return ProductTag::where('id', $tagId)->first();
    }
}
