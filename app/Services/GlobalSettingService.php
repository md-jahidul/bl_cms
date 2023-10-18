<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Enums\GlobalSettingConst;
use App\Repositories\GlobalSettingRepository;
use App\Traits\CrudTrait;
use App\Traits\RedisTrait;
use Illuminate\Http\Response;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class GlobalSettingService
{
    use CrudTrait;
    use RedisTrait;

    /**
     * @var GlobalSettingRepository
     */
    protected $settingRepository;


    /**
     * SettingService constructor.
     * @param GlobalSettingRepository $settingRepository
     */
    public function __construct(GlobalSettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->setActionRepository($settingRepository);
    }

    public function getFilteredData($filterKey)
    {
        return $this->settingRepository->getFilteredData($filterKey);
    }


    /**
     * Storing the banner resource
     * @param $request
     * @return array
     */
    public function storeSetting($request): array
    {
        $setting = $this->settingRepository->is_exist($request['settings_key']);
        $setting_response = [];
        if (isset($setting)) {
            $setting_response['saved'] = false;
            $setting_response['response'] = new Response("Setting Already exists");

        } else {
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            $this->settingRepository->save($data);
            $setting_response['saved'] = true;
            $setting_response['response'] = new Response("Setting has been successfully created");
        }
        $this->delGlobalSettingCache();
        return $setting_response;
    }

    /**
     * Updating the banner
     * @param $data
     * @param $id
     * @return Response
     */
    public function updateSetting($data, $id): Response
    {
        $setting = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        $setting->update($data);
        $this->delGlobalSettingCache();
        return new Response("Setting has been successfully updated");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroySetting($id)
    {
        $setting = $this->findOne($id);
        $setting->delete();
        $this->delGlobalSettingCache();
        return Response('Setting has been successfully deleted');
    }

    public function delGlobalSettingCache($redisKey = 'product-special-types')
    {
        $this->redisDel(GlobalSettingConst::SETTINGS_REDIS_KEY);
    }

}
