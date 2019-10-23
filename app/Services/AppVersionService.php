<?php
namespace App\Services;

use App\Repositories\AppVersionRepository;

class AppVersionService
{

    /**
     * @var AppVersionRepository
     */
    protected $appVersionRepository;


    /**
     * AppVersionService constructor.
     * @param AppVersionRepository $appVersionRepository
     */
    public function __construct(AppVersionRepository $appVersionRepository)
    {
         $this->appVersionRepository = $appVersionRepository;
    }


    public function getVersionInfo()
    {
        return $this->appVersionRepository->findAll();
    }



}
