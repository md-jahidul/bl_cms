<?php

namespace App\Services\AssetLite;

use App\Repositories\AppServiceCategoryRepository;

use App\Repositories\AppServiceVendorApiRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AppServiceVendorApiService
{
    use CrudTrait;

    /**
     * @var $menuRepository
     */
    protected $appServiceVendorApiRepository;

    /**
     * AppServiceCategoryService constructor.
     * @param AppServiceVendorApiRepository $appServiceVendorApiRepository
     */
    public function __construct(AppServiceVendorApiRepository $appServiceVendorApiRepository)
    {
        $this->appServiceVendorApiRepository = $appServiceVendorApiRepository;
        $this->setActionRepository($appServiceVendorApiRepository);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeAppServiceVendorApi($data)
    {
        $data['end_point_url'] = str_replace(' ', '', strtolower($data['end_point_url']));
        $this->save($data);
        return new Response('App Service vendor API added successfully');
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateAppServiceVendorApi($data, $id)
    {
        $appServiceVendorApi = $this->findOne($id);
        $appServiceVendorApi->update($data);
        return Response('App Service vendor API updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function deleteAppServiceVendorApi($id)
    {
        $appServiceVendorApi = $this->findOne($id);
        $appServiceVendorApi->delete();
        return Response('App Service vendor API deleted successfully !');
    }
}
