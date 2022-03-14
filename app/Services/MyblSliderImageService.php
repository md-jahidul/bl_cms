<?php

namespace App\Services;

use App\Models\BaseImageCta;
use App\Models\MyBlProduct;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\SliderImageRepository;
use Illuminate\Support\Facades\Redis;

class MyblSliderImageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $sliderImageRepository;

    /**
     * AlSliderImageService constructor.
     * @param SliderImageRepository $sliderImageRepository
     */
    public function __construct(SliderImageRepository $sliderImageRepository)
    {
        $this->sliderImageRepository = $sliderImageRepository;
        $this->setActionRepository($sliderImageRepository);
    }


    public function itemList($sliderId, $type)
    {
        return $this->sliderImageRepository->getSliderImage($sliderId, $type);
    }


    /**
     * Storing the banner resource
     * @return Response
     */
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
                $image['image_url'] = 'storage/' . $image['image_url']->store('Slider_image');
                $image['sequence'] = $i;
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
                $sliderImg = $this->save($image);
                if (!empty($image['segment_wise_cta'][0]['group_id']) &&
                    !empty($image['segment_wise_cta'][0]['action_name'])
                ) {
                    foreach ($image['segment_wise_cta'] as $segmentCTA) {
                        $segmentCTA['banner_id'] = $sliderImg->id;
                        BaseImageCta::create($segmentCTA);
                    }
                }

                /**
                 * Removing redis cache for segment banner to impact the change
                 */
                if ($sliderImg->user_type === 'segment_wise_banner') {
                    $this->delSliderRedisCache();
                }
            });

            return new Response("Image has been successfully added");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return $e->getMessage();
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

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSliderImage($data, $id)
    {
        try {
            $sliderImage = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $sliderImage) {
                if (isset($data['image_url'])) {
                    $data['image_url'] = 'storage/' . $data['image_url']->store('Slider_image');
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
            /**
             * Removing redis cache for segment banner to impact the change
             */
            if ($sliderImage->user_type === 'segment_wise_banner') {
                $this->delSliderRedisCache();
            }
            return response("Image has has been successfully updated");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return \response($e->getMessage(), 500);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSliderImage($id)
    {
        $sliderImage = $this->findOne($id);
        $sliderImage->delete();
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
