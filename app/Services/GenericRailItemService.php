<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\GenericRailItemRepository;
use App\Repositories\GenericRailRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class GenericRailItemService
{
    use CrudTrait;

    public $genericRailItemRepository;
    public $genericRailService;

    public function __construct(
        GenericRailItemRepository $genericRailItemRepository,
        GenericRailService $genericRailService
    ) {
        $this->genericRailItemRepository = $genericRailItemRepository;
        $this->genericRailService = $genericRailService;
        $this->setActionRepository($genericRailItemRepository);

    }
    public function itemList($railId)
    {
        return $this->genericRailItemRepository->getItems($railId);
    }

    public function storeItem($data)
    {
        try {
            $railData = $this->genericRailService->findOne($data['generic_rail_id']);

            $data['display_order'] = count($this->genericRailItemRepository->findAll()) + 1;
            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $this->genericRailItemRepository->save($data);

            if ($railData['component_for'] == 'non_bl') {
                Helper::removeVersionControlRedisKey('nonbl');
            }
            else {
                Helper::removeVersionControlRedisKey($railData['component_for']);
            }
            Redis::del('generic_rail_data');

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($data, $itemId)
    {
        try {
            $itemData = $this->genericRailItemRepository->findOne($itemId);
            $railData = $this->genericRailService->findOne($itemData['generic_rail_id']);

            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $itemData->update($data);

            if ($railData['component_for'] == 'non_bl') {
                Helper::removeVersionControlRedisKey('nonbl');
            } else {
                Helper::removeVersionControlRedisKey($railData['component_for']);
            }
            Redis::del('generic_rail_data');

            return true;

        } catch (\Exception $e) {

            return false;
        }
    }

    public function deleteItem($itemId)
    {
        try {

            $itemData = $this->genericRailItemRepository->findOne($itemId);
            $railData = $this->genericRailService->findOne($itemData['generic_rail_id']);

            $itemData->delete();
            Helper::removeVersionControlRedisKey($railData['component_for']);
            Redis::del('generic_rail_data');

            return $railData['id'];

        } catch (\Exception $e) {

            return $railData['id'];
        }
    }
}
