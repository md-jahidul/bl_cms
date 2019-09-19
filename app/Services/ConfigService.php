<?php


namespace App\Services;


use App\Models\Config;
use App\Repositories\ConfigRepository;
use App\Traits\CrudTrait;

class ConfigService
{

    use CrudTrait;

    /**
     * @var $configRepository
     */
    protected $configRepository;

    /**
     * ConfigService constructor.
     * @param ConfigRepository $configRepository
     */
    public function __construct(ConfigRepository $configRepository)
    {
        $this->configRepository = $configRepository;
        $this->setActionRepository($configRepository);
    }


    public function updateConfigData($request)
    {
        if (isset($request['site_logo'])){
            $imageUrl = $this->imageUpload($request, 'site_logo', $request['logo_alt_text'],'images/logo');
        }
        $items = request()->except(['_token','_method']);
        foreach ($items as $key => $value){
            $config = $this->configRepository->updateConfig($key);
            $config->value = $value;
            if ($key == "site_logo"){
                $config->value = env("APP_URL").'/images/logo/'.$imageUrl;
            }
            $config->save();
        }


        return Response('Settings Page updated successfully');
    }
}
