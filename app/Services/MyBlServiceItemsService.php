<?php

namespace App\Services;

use App\Helpers\Helper;
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

    protected $serviceItemRepository;


    /**
     * AlSliderImageService constructor.
     * @param MyBlServiceItemRepository $serviceItemRepository
     */
    protected const REDIS_KEY = "mybl_component_service";

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
                $items['tags'] = implode(', ', $items['tag']);
                $items['sequence'] = $i;
                $items['component_identifier'] = str_replace(' ', '_', strtolower($items['title_en']));
                $version_code = Helper::versionCode($items['android_version_code'], $items['ios_version_code']);
                $items = array_merge($items, $version_code);
                unset($items['android_version_code'], $items['ios_version_code']);
                $items = $this->save($items);
            });
            self::removeServiceRedisKey();
            return new Response("Items has been successfully added");
        } catch (\Exception $e) {
            Log::error('Item store failed' . $e->getMessage());
            return \response($e->getMessage(), 500);
        }
    }


    public function tableSortable($data)
    {
        $this->serviceItemRepository->serviceItemTableSort($data);
        self::removeServiceRedisKey();
        return new Response('Sequence has been successfully update');
    }


    public function updateServiceItems($data, $id)
    {
        try {
            $serviceItems = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $serviceItems) {
                $data['tags'] = implode(', ', $data['tag']);
                $serviceItems->update($data);
            });
            self::removeServiceRedisKey();
            return response("Item has has been successfully updated");
        } catch (\Exception $e) {
            Log::error('Item store failed' . $e->getMessage());
            return \response($e->getMessage(), 500);
        }
    }


    public function deleteServiceItem($id)
    {
        $serviceItem = $this->findOne($id);
        $serviceItem->delete();
        self::removeServiceRedisKey();
        return Response('Item has been successfully deleted');
    }

    public static function removeServiceRedisKey($keyName = '')
    {
        Redis::del(self::REDIS_KEY);
    }

}
