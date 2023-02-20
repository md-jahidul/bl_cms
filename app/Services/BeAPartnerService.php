<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\BeAPartnerRepository;
use App\Repositories\FourGCampaignRepository;
use App\Repositories\FourGLandingPageRepository;
use App\Repositories\MediaLandingPageRepository;
use App\Repositories\MediaPressNewsEventRepository;
use App\Repositories\MediaTvcVideoRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BeAPartnerService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var BeAPartnerRepository
     */
    private $beAPartnerRepository;

    /**
     * DigitalServicesService constructor.
     * @param BeAPartnerRepository $beAPartnerRepository
     */
    public function __construct(
        BeAPartnerRepository $beAPartnerRepository
    ) {
        $this->beAPartnerRepository = $beAPartnerRepository;
        $this->setActionRepository($beAPartnerRepository);
    }

    public function beAPartnerData()
    {
        return $this->beAPartnerRepository->getOneData();
    }

    public function beAPartnerUpdate($data, $id)
    {
        $beAPartner = $this->findOne($id);

        $dirPath = 'assetlite/images/banner/be-a-partner';
        if (!empty($data['banner_image'])) {
            $data['banner_image'] = $this->upload($data['banner_image'], $dirPath);
            $this->deleteFile($beAPartner->banner_image);
        }
        if (!empty($data['banner_mobile_view'])) {
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
            $this->deleteFile($beAPartner->banner_mobile_view);
        }
        if (!$beAPartner) {
            $this->save($data);
        } else {
            $beAPartner->update($data);
        }
        return response('Be A Partner Data updated!!');
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateComponent($data, $id)
    {
        $component = $this->findOne($id);
        $data['updated_by'] = Auth::id();
        $component->update($data);
        return Response('Component has been successfully updated');
    }

    public function getBannerImage()
    {
        return $this->fourGLandingPageRepository->findOneByProperties(['component_type' => 'banner_image']);
    }

//    public function bannerImageUpload($data)
//    {
//        $comType = $data['component_type'];
//        $bannerImage = $this->fourGLandingPageRepository->findOneByProperties(['component_type' => $comType]);
//
//        $dirPath = 'assetlite/images/banner/four-g';
//        if (!empty($data['items']['banner_image_url'])) {
//            $data['items']['banner_image_url'] = $this->upload($data['items']['banner_image_url'], $dirPath);
//        }
//        if (!empty($data['items']['banner_mobile_view'])) {
//            $data['items']['banner_mobile_view'] = $this->upload($data['items']['banner_mobile_view'], $dirPath);
//        }
//
//        if (!$bannerImage) {
//            $data['component_type'] = $comType;
//            $data['created_by'] = Auth::id();
//            $this->save($data);
//        } else {
//            // get original data
//            $new_multiple_attributes = $bannerImage->items;
//
//            // contains all the inputs from the form as an array
//            $input_multiple_attributes = isset($data['items']) ? $data['items'] : null;
//
//            // loop over the product array
//            if ($input_multiple_attributes) {
//                foreach ($input_multiple_attributes as $field => $inputData) {
//                    $new_multiple_attributes[$field] = $inputData;
//                }
//            }
//            $data['items'] = $new_multiple_attributes;
//            $data['updated_by'] = Auth::id();
//            $bannerImage->update($data);
//        }
//        return Response('Banner Image update successfully!!');
//    }


}
