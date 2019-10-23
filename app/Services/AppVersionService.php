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


    /**
     * Version Info
     * @return mixed
     */
    public function getVersionInfo()
    {
        return $this->appVersionRepository->findAll();
    }


    /**
     * @param $request
     * @return mixed
     */
    public function createAppVersion($request)
    {
        return $this->appVersionRepository->create($request->all());
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateAppVersion($data, $version)
    {
        return  $version->update($data->all());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteAppVersion($id)
    {
        $banner = $this->findOne($id);
        return $banner->delete();
    }



}
