<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services;

use App\Repositories\AppServiceTabRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AppServiceTabService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $appServiceTabRepository
     */
    protected $appServiceTabRepository;

    /**
     * AppServiceTabService constructor.
     * @param AppServiceTabRepository $appServiceTabRepository
     */
    public function __construct(AppServiceTabRepository $appServiceTabRepository)
    {
        $this->appServiceTabRepository = $appServiceTabRepository;
        $this->setActionRepository($appServiceTabRepository);
    }

    /**
     * Updating the OfferCategory
     * @param $data
     * @return Response
     */
    public function updateTabs($data, $id)
    {
        $appServiceTabs = $this->findOne($id);
        if (request()->hasFile('banner_image_url')) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/app-service-tab');
        }
        $appServiceTabs->update($data);
        return Response('App Service Tab updated successfully');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws Exception
     */
//    public function deleteAppServiceTab($id)
//    {
//        $appServiceTabs = $this->findOne($id);
//        $appServiceTabs->delete();
//        return Response('App Service Tab deleted successfully !');
//    }


}
