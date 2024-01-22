<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\MyBlServiceRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MyBlServiceComponentService
{
    use CrudTrait;

    /**
     * @var MyBlServiceRepository
     */
    private $blServiceRepository;
    protected const REDIS_KEY = "mybl_component_service";

    public function __construct(
        MyBlServiceRepository $blServiceRepository
    )
    {
        $this->blServiceRepository = $blServiceRepository;
        $this->setActionRepository($blServiceRepository);
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $service_data = $this->blServiceRepository->serviceSequence();
            if (empty($service_data)) {
                $i = 1;
            } else {
                $i = $service_data->sequence + 1;
            }

            $data['status'] = 1;
            $data['sequence'] = $i;

            /**
             * Version Control
             */
            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $service = $this->save($data);
            DB::commit();
            self::removeServiceRedisKey();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }

    }

    public function servicesTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->blServiceRepository->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        self::removeServiceRedisKey();
        return "success";
    }

    public function getServices()
    {
        return $this->blServiceRepository->getServices();
    }

    public function updateService($data, $id)
    {
        try {
            DB::beginTransaction();
            $service = $this->blServiceRepository->findOne($id);

            $version_code = Helper::versionCode($data['android_version_code'], $data['ios_version_code']);
            $data = array_merge($data, $version_code);
            unset($data['android_version_code'], $data['ios_version_code']);

            $service->update($data);
            DB::commit();

            self::removeServiceRedisKey();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());
            return false;
        }
    }


    public function deleteService($id): array
    {
        try {
            $this->delete($id);

            self::removeServiceRedisKey();

            return [
                'message' => 'Service deleted successfully',
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Service delete failed',
            ];
        }
    }

    public static function removeServiceRedisKey($keyName = '')
    {
        Redis::del(self::REDIS_KEY);
    }
}
