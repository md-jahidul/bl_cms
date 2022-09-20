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

    public function __construct(
        MyBlProductSchedulerRepository $myblProductScheduleRepository,
        MyBlProductRepository $myBlProductRepository,
        MyBlProductTagRepository $myBlProductTagRepository
    ) {
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
        $this->myblProductRepository = $myBlProductRepository;
        $this->myblProductTagRepository = $myBlProductTagRepository;
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

        foreach ($products as $product) {

            $productSchedule = $this->myblProductScheduleRepository->findScheduleDataByProductCodeV2($product['product_code']);

            $this->removeRedisKeyByBaseGroupId($productSchedule);

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
                    $productTags = $this->myblProductTagRepository->findTagIdByProductCode($product['product_code']);

                    $productScheduleData['tags'] = null;
                    $productData['tag'] = null;
                    if(!$productTags->isEmpty()) {
                        $productScheduleData['tags'] = $productTags;
                    }
                    if ($productScheduleData['tags'] != null) {
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
            } elseif ($currentTime > $productSchedule['end_date'] && $productSchedule['change_state_status'] == 1) {

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
                    }
                    if ($productScheduleData['tags'] != null) {
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
            }
        }
    }

    public function cancelSchedule($id)
    {
        $productSchedule = $this->myblProductScheduleRepository->findOne($id);
        $product = ($this->myblProductRepository->findByProperties(['product_code' => $productSchedule->product_code], ['*']))->first();

        $productData = [];
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
            if ($productScheduleData['tags'] != null) {
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

        $productScheduleData['change_state_status'] = 0;
        $productScheduleData['is_cancel'] = 1;
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
    }

    public function getTag($tagId) {

        return ProductTag::where('id', $tagId)->first();
    }
}