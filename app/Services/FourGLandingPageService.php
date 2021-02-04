<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
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

class FourGLandingPageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var FourGLandingPageRepository
     */
    private $fourGLandingPageRepository;
    /**
     * @var FourGCampaignRepository
     */
    private $fourGCampaignRepository;


    /**
     * DigitalServicesService constructor.
     * @param FourGLandingPageRepository $fourGLandingPageRepository
     * @param FourGCampaignRepository $fourGCampaignRepository
     */
    public function __construct(
        FourGLandingPageRepository $fourGLandingPageRepository,
        FourGCampaignRepository $fourGCampaignRepository
    )
    {
        $this->fourGLandingPageRepository = $fourGLandingPageRepository;
        $this->fourGCampaignRepository = $fourGCampaignRepository;
        $this->setActionRepository($fourGLandingPageRepository);
    }

    public function findWithoutBanner()
    {
        return $this->fourGLandingPageRepository->findWithoutBanner();
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

    public function bannerImageUpload($data)
    {
        $comType = $data['component_type'];
        $bannerImage = $this->fourGLandingPageRepository->findOneByProperties(['component_type' => $comType]);

        $data['banner_image_url'] =  $bannerImage->items['banner_image_url'] ?? null;
        $data['banner_mobile_view'] = $bannerImage->items['banner_mobile_view'] ?? null;

        $dirPath = 'assetlite/images/banner/four-g';
        if (!empty($data['items']['banner_image_url'])) {
            $data['items']['banner_image_url'] = $this->upload($data['items']['banner_image_url'], $dirPath);
            $data['banner_image_url'] = $data['items']['banner_image_url'];
        }
        if (!empty($data['items']['banner_mobile_view'])) {
            $data['items']['banner_mobile_view'] = $this->upload($data['items']['banner_mobile_view'], $dirPath);
            $data['banner_mobile_view'] = $data['items']['banner_mobile_view'];
        }

        if(!empty($data['items']['banner_name_en'])) {
            $data['banner_name_en'] = $data['items']['banner_name_en'];
        }

        if(!empty($data['items']['banner_name_bn'])) {
            $data['banner_name_bn'] = $data['items']['banner_name_bn'];
        }

        if (!$bannerImage) {
            $data['component_type'] = $comType;
            $data['created_by'] = Auth::id();
            $this->save($data);
        } else {
            // get original data
            $new_multiple_attributes = $bannerImage->items;

            // contains all the inputs from the form as an array
            $input_multiple_attributes = isset($data['items']) ? $data['items'] : null;

            // loop over the product array
            if ($input_multiple_attributes) {
                foreach ($input_multiple_attributes as $field => $inputData) {
                    $new_multiple_attributes[$field] = $inputData;
                }
            }
            $data['items'] = $new_multiple_attributes;
            $data['updated_by'] = Auth::id();
            $bannerImage->update($data);
        }
        return Response('Banner Image update successfully!!');
    }


}
