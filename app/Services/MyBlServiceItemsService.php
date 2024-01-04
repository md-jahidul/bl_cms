<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\MyBlProduct;
use App\Repositories\MyBlServiceItemRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MyBlServiceItemsService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $sliderRepository
     */
    protected $serviceItemRepository;

    /**
     * AlSliderImageService constructor.
     * @param MyBlServiceItemRepository $serviceItemRepository
     */

    public function __construct(MyBlServiceItemRepository $serviceItemRepository)
    {
        $this->serviceItemRepository = $serviceItemRepository;
        $this->setActionRepository($serviceItemRepository);
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

    public function itemList($service_id): array
    {
        $service_items = $this->serviceItemRepository->getServiceItems($service_id);
        return $this->separatedActiveAndInactive($service_items);
    }


    public function storeServiceItems($items)
    {
        try {
            DB::transaction(function () use ($items) {
                $items_data = $this->serviceItemRepository->getLastServiceItems($items['my_bl_service_id']);
                if (empty($items_data)) {
                    $i = 1;
                } else {
                    $i = $items_data->sequence + 1;
                }
                $items['sequence'] = $i;
                $items['component_identifier'] = str_replace(' ', '_', strtolower($items_data['title_en']));

                if (isset($items['tags'])) {
                    $tagsArray = explode(",", $items['tags']);
                    $tagsJson = json_encode($tagsArray);
                    $items['tags'] = $tagsJson;
                }
                $version_code = Helper::versionCode($items['android_version_code'], $items['ios_version_code']);
                $items = array_merge($items, $version_code);
                unset($items['android_version_code'], $items['ios_version_code']);
                $items = $this->save($items);
            });

            return new Response("Image has been successfully added");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            // return $e->getMessage();
            return \response($e->getMessage(), 500);
        }
    }

    public function getActiveProducts()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data', 'voice', 'sms', 'mix']);
            }
        )->get();

        $data = [];

        foreach ($products as $product) {
            $data [] = [
                'id' => $product->details->product_code,
                'text' => $product->details->product_code . ' - (' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return $data;
    }

    public function tableSortable($data)
    {
        $this->serviceItemRepository->serviceItemTableSort($data);
        return new Response('Sequence has been successfully update');
    }


    public function updateServiceItems($data, $id)
    {
        try {
            $serviceItems = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $serviceItems) {
                $serviceItems->update($data);
            });

            return response("Image has has been successfully updated");
        } catch (\Exception $e) {
            Log::error('Slider Image store failed' . $e->getMessage());
            return \response($e->getMessage(), 500);
        }
    }


    public function deleteServiceItem($id)
    {
        $serviceItem = $this->findOne($id);
        $serviceItem->delete();
        /**
         * Removing redis cache for segment banner to impact the change
         */
//        if ($sliderImage->user_type === 'segment_wise_banner') {
//            $this->delSliderRedisCache();
//        }
        return Response('Image has been successfully deleted');
    }

    public function delSliderRedisCache($redisKey = 'mybl_segmented_banners')
    {
        Redis::del($redisKey);
    }
}
