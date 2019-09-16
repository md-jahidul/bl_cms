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
    public function storeSetting($request)
    {
        unset($request['_token']);
        unset($request['_method']);
        $setting = $this->settingRepository->is_exist($request['setting_key_id']);
        //dd($request);
        
        if(isset($setting)){
            $settings = $this->findOne($setting->id);
            $settings->update($request);
        }else{
            $this->save($request);
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
