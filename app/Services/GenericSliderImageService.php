<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\BaseImageCta;
use App\Models\MyBlProduct;
use App\Repositories\GenericSliderImageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\SliderImageRepository;
use Illuminate\Support\Facades\Redis;

class GenericSliderImageService
{
    use CrudTrait;
    use FileTrait;

    protected $sliderImageRepository;
    public function __construct(GenericSliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }

    public function separatedActiveAndInactive($data): array
    {
        $activeImages = [];
        $inActiveImages = [];
        foreach ($data as $image) {
            if ($image->is_active == 1 && $image->visibilityStatus()) {
                $activeImages[] = $image;
            } else {
                $inActiveImages[] = $image;
            }
        }
        return array_merge($activeImages, $inActiveImages);
    }

    public function itemList($sliderId)
    {
        $sliderImages = $this->sliderImageRepository->getSliderImage($sliderId);
        return $this->separatedActiveAndInactive($sliderImages);
    }

    public function storeSliderImage($image)
    {

        try {
            DB::transaction(function () use ($image) {
                $image_data = $this->sliderImageRepository->sliderImage($image['slider_id']);
                if (empty($image_data)) {
                    $i = 1;
                } else {
                    $i = $image_data->sequence + 1;
                }
                $image['image_url'] = 'storage/' . $image['image_url']->store('generic-slider');
                $image['sequence'] = $i;
                $image['generic_slider_id'] = $image['slider_id'];
                $image['banner_text_en'] = $image['banner_text_en'] ?? null;
                $image['banner_text_bn'] = $image['banner_text_bn'] ?? null;
                if (isset($image['other_attributes'])) {
                    if ($image['redirect_url'] == "FEED_CATEGORY") {
                        $other_attributes = $image['other_attributes'];
                    } else {
                        $other_attributes = [
                            'type' => strtolower($image['redirect_url']),
                            'content' => $image['other_attributes']
                        ];
                    }
                    // $image['other_attributes'] = json_encode($other_attributes, JSON_UNESCAPED_SLASHES);
                    $image['other_attributes'] = $other_attributes;
                }


                /**
                 * Version Control
                 */
                $version_code = Helper::versionCode($image['android_version_code'], $image['ios_version_code']);
                $image = array_merge($image, $version_code);
                unset($image['android_version_code'], $image['ios_version_code']);


                $sliderImg = $this->save($image);
                if (!empty($image['segment_wise_cta'][0]['group_id']) &&
                    !empty($image['segment_wise_cta'][0]['action_name'])
                ) {
                    foreach ($image['segment_wise_cta'] as $segmentCTA) {
                        $segmentCTA['banner_id'] = $sliderImg->id;
                        BaseImageCta::create($segmentCTA);
                    }
                }

            });

            Helper::removeVersionControlRedisKey();
            $keys = ['non_bl_offer', 'lms_component_prepaid', 'lms_component_postpaid', 'lms_old_user_postpaid', 'lms_old_user_prepaid', 'toffee_banner', 'top_visit_slider', 'generic_component_data'];
            Redis::del($keys);

            return true;
        } catch (\Exception $e) {

            Log::error('Slider Image store failed' . $e->getMessage());
            return false;
        }
    }

    public function getActiveProducts()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data','voice','sms', 'mix']);
            }
        )->get();

        $data = [];

        foreach ($products as $product) {
            $data [] = [
                'id'    => $product->details->product_code,
                'text' =>  $product->details->product_code . ' - (' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return $data;
    }

    public function tableSortable($data)
    {
        $this->sliderImageRepository->sliderImageTableSort($data);
        return new Response('Sequence has been successfully update');
    }

    public function editSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $android_version_code = implode('-', [$sliderImage['android_version_code_min'], $sliderImage['android_version_code_max']]);
        $ios_version_code = implode('-', [$sliderImage['ios_version_code_min'], $sliderImage['ios_version_code_max']]);
        $sliderImage->android_version_code = $android_version_code;
        $sliderImage->ios_version_code = $ios_version_code;

        return $sliderImage;
    }

    public function updateSliderImage($data, $id)
    {
        try {
            $sliderImage = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $sliderImage) {
                if (isset($data['image_url'])) {
                    $data['image_url'] = 'storage/' . $data['image_url']->store('generic-slider');
                    $this->deleteFile($sliderImage->image_url);
                }
                if (isset($data['other_attributes'])) {
                    if ($data['redirect_url'] == "FEED_CATEGORY") {
                        $other_attributes = $data['other_attributes'];
                    } else {
                        $other_attributes = [
                            'type' => strtolower($data['redirect_url']),
                            'content' => $data['other_attributes']
                        ];
                    }
                    $data['other_attributes'] = $other_attributes;
                }

                /**
                 * Version Control
                 */
                $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
                $data = array_merge($data, $version_code);
                unset($data['android_version_code'], $data['ios_version_code']);

                $sliderImage->update($data);

                if (!empty($data['segment_wise_cta'][0]['group_id']) &&
                    !empty($data['segment_wise_cta'][0]['action_name'])
                ) {
                    BaseImageCta::where('banner_id', $id)->delete();
                    foreach ($data['segment_wise_cta'] as $segmentCTA) {
                        $segmentCTA['banner_id'] = $id;
                        BaseImageCta::create($segmentCTA);
                    }
                } else {
                    BaseImageCta::where('banner_id', $id)->delete();
                }
                if (
                    $data['user_type'] == 'all' ||
                    $data['user_type'] == 'prepaid' ||
                    $data['user_type'] == 'postpaid'
                ) {
                    BaseImageCta::where('banner_id', $id)->delete();
                }
            });

            Helper::removeVersionControlRedisKey();
            $keys = ['non_bl_offer', 'lms_component_prepaid', 'lms_component_postpaid', 'lms_old_user_postpaid', 'lms_old_user_prepaid', 'toffee_banner', 'top_visit_slider', 'generic_component_data'];
            Redis::del($keys);

            return true;
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return false;
        }
    }

    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $sliderImage->delete();

        Helper::removeVersionControlRedisKey();
        $keys = ['non_bl_offer', 'lms_component_prepaid', 'lms_component_postpaid', 'lms_old_user_postpaid', 'lms_old_user_prepaid', 'toffee_banner', 'top_visit_slider', 'generic_component_data'];
        Redis::del($keys);
        /**
         * Removing redis cache for segment banner to impact the change
         */
        if ($sliderImage->user_type === 'segment_wise_banner') {
            $this->delSliderRedisCache();
        }
        return Response('Image has been successfully deleted');
    }

    public function delSliderRedisCache($redisKey = 'mybl_segmented_banners')
    {
        Redis::del($redisKey);
    }
}
