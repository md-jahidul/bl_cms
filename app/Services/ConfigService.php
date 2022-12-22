<?php

namespace App\Services;

use App\Models\Config;
use App\Repositories\ConfigRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;

class ConfigService
{
    use CrudTrait;
    use FileTrait;

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
        if (request()->hasFile('site_logo')) {
            $imageUrl = $this->upload($request['site_logo'], 'assetlite/images/logo');
        }
        if (request()->hasFile('login_page_banner')) {
            $LoginBanner = $this->upload($request['login_page_banner'], 'assetlite/images/banner');
        }
        $items = request()->except(['_token','_method']);
        foreach ($items as $key => $value) {
            $config = $this->configRepository->updateConfig($key);
            $config->value = $value;
            if ($key == "site_logo") {
                $config->value = $imageUrl;
            }elseif($key == "login_page_banner"){
                $config->value = $LoginBanner;
            }
            $config->save();
        }


        return Response('Settings Page updated successfully');
    }
}
