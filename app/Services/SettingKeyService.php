<?php
/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;


use App\Repositories\SettingKeyRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use DB;


class SettingKeyService
{

    use CrudTrait;
    /**
     * @var $sliderRepository
     */
    protected $settingKeyRepository;

    /**
     * DigitalServicesService constructor.
     * @param SliderImageRepository $sliderTypeRepository
     */
    public function __construct(SettingKeyRepository $settingKeyRepository)
    {
        $this->settingKeyRepository = $settingKeyRepository;
        $this->setActionRepository($settingKeyRepository);
    }

    /**
     * Storing the banner resource
     * @return Response
     */
    public function storeSettingKey($request)
    {
        $this->save($request);
        return new Response("Setting Key has been successfully created");
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateSettingKey($data, $id)
    {
        $sliderImage->update($data);
        return new Response("Setting Key has successfully been updated to slider");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteSetting($id)
    {
        
        $sliderImage->delete();
        return Response('Setting Key has been successfully deleted');
    }

}
