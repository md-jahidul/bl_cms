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
        $this->configRepository->updateConfig($request);
        return Response('Settings Page updated successfully');
    }
}
