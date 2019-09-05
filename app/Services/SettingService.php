<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SettingRepository ;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;


class SettingService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $settingRepository;

    /**
     * DigitalServicesService constructor.
     * @param SettingRepository $sliderTypeRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->setActionRepository($settingRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSetting($settings)
    {
        unset($settings['_token']);
        unset($settings['_method']);
        if(DB::table('settings')->where('setting_key_id',$settings['setting_key_id'])){
            $setting = DB::table('settings')->where('setting_key_id',$settings['setting_key_id']);
            $setting->update($settings);
        }else{
            $this->save($settings);
        }
        return new Response("Satting successfully been Added");
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
        return new Response("Satting successfully been updated");
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
        return Response('Satting deleted successfully !');
    }

}
