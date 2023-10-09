<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\GlobalSettingRepository;
use App\Repositories\SettingRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;

class GlobalSettingService
{
    use CrudTrait;


    /**
     * @var SettingRepository
     */
    protected $settingRepository;


    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(GlobalSettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->setActionRepository($settingRepository);
    }

    /**
     * Storing the banner resource
     * @return array
     */
    public function storeSetting($request)
    {
        $setting = $this->settingRepository->is_exist($request['settings_key']);
        $setting_response = [];
        if (isset($setting)) {
            $setting_response['saved'] = false;
            $setting_response['response'] = new Response("Setting Already exists");

        } else {
            $this->settingRepository->save($request->all());
            $setting_response['saved'] = true;
            $setting_response['response'] = new Response("Setting has been successfully created");
        }
        return $setting_response;
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSetting($data, $id)
    {
        $setting = $this->findOne($id);
        $setting->update($data);
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
        return Response('Setting has been successfully deleted');
    }
}
