<?php

namespace App\Services;

use App\Models\BaseImageCta;
use App\Models\MyBlProduct;
use App\Repositories\LiveContentRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenericCarouselService
{
    use CrudTrait;
    use FileTrait;

    protected $liveContentRepository;

    public function __construct(LiveContentRepository $liveContentRepository)
    {
        $this->liveContentRepository = $liveContentRepository;
        $this->setActionRepository($liveContentRepository);
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

    // public function itemList($sliderId)
    // {
    //     $sliderImages = $this->sliderImageRepository->getSliderImage($sliderId);
    //     return $this->separatedActiveAndInactive($sliderImages);
    // }

    public function getCarouselImage()
    {
        return $this->liveContentRepository->getCarouselImage();
    }

    public function storeCarouseImage($image)
    {
        try {
            DB::transaction(function () use ($image) {
                $image_data = $this->liveContentRepository->carouselImage();
                $i = 1;
                if (!empty($image_data)) {
                    $i = $image_data->display_order + 1;
                }
                $image['image_url'] = 'storage/' . $image['image_url']->store('live-content');
                $image['display_order'] = $i;

                $carouselImg = $this->save($image);

            });
            Redis::del('mybl_home_component');
            Redis::del('content_component');
            return true;
        } catch (\Exception $e) {
            Log::error('Carousel Image store failed' . $e->getMessage());
            return false;
        }
    }



    public function tableSortable($data)
    {
        $this->liveContentRepository->sliderImageTableSort($data);
        Redis::del('mybl_home_component');
        Redis::del('content_component');
        return new Response('Sequence has been successfully update');
    }

    public function updateCarouselImage($data, $id)
    {
        try {
            $sliderImage = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $sliderImage) {
                if (isset($data['image_url'])) {
                    $data['image_url'] = 'storage/' . $data['image_url']->store('live-content');
                    $this->deleteFile($sliderImage->image_url);
                }
                
                $sliderImage->update($data);
            });
            Redis::del('mybl_home_component');
            Redis::del('content_component');
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
