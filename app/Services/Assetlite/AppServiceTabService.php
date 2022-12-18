<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services\AssetLite;

use App\Repositories\AppServiceTabRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        if (!empty($data['banner_image_url'])) {
            //delete old web photo
            if ($data['old_web_img'] != "") {
                $this->deleteFile($data['old_web_img']);
            }
            $photoName = $data['banner_name'] . '-web';
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/app-service-tab', $photoName);
            $status = $data['banner_image_url'];
        }

        if (!empty($data['banner_image_mobile'])) {
            //delete old web photo
            if ($data['old_mob_img'] != "") {
                $this->deleteFile($data['old_mob_img']);
            }
            $photoName = $data['banner_name'] . '-mobile';
            $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/banner/app-service-tab', $photoName);
            $status = $data['banner_image_mobile'];
        }

        //only rename
        if ($data['old_banner_name'] != $data['banner_name']) {
            if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
                $fileName = $data['banner_name'] . '-web';
                $directoryPath = 'assetlite/images/banner/app-service-tab';
                $data['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
                $status = $data['banner_image_url'];
            }
            if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
                $fileName = $data['banner_name'] . '-mobile';
                $directoryPath = 'assetlite/images/banner/app-service-tab';
                $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
                $status = $data['banner_image_mobile'];
            }
        }

        $data['updated_by'] = Auth::id();

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
