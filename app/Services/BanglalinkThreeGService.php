<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\BanglalinkThreeGRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BanglalinkThreeGService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var BanglalinkThreeGRepository
     */
    private $banglalinkThreeGRepository;


    /**
     * DigitalServicesService constructor.
     * @param BanglalinkThreeGRepository $banglalinkThreeGRepository
     */
    public function __construct(
        BanglalinkThreeGRepository $banglalinkThreeGRepository
    ) {
        $this->banglalinkThreeGRepository = $banglalinkThreeGRepository;
        $this->setActionRepository($banglalinkThreeGRepository);
    }

    public function findWithoutBanner()
    {
        return $this->banglalinkThreeGRepository->findWithoutBanner();
    }

    /**
     * Updating the banner
     * @param $data
     * @return Response
     */
    public function updateComponent($data, $id)
    {
        $component = $this->findOne($id);
        $component->update($data);
        return Response('Component has been successfully updated');
    }

    public function getBannerImage()
    {
        return $this->banglalinkThreeGRepository->findOneByProperties(['type' => 'banner_image']);
    }

    public function bannerImageUpload($data)
    {
        $comType = $data['type'];
        $bannerImage = $this->banglalinkThreeGRepository->findOneByProperties(['type' => $comType]);

        $dirPath = 'assetlite/images/banner/three-g';
        if (!empty($data['other_attributes']['banner_image_url'])) {
            $data['other_attributes']['banner_image_url'] = $this->upload($data['other_attributes']['banner_image_url'], $dirPath);
        }
        if (!empty($data['other_attributes']['banner_mobile_view'])) {
            $data['other_attributes']['banner_mobile_view'] = $this->upload($data['other_attributes']['banner_mobile_view'], $dirPath);
        }

        if (!$bannerImage) {
            $data['type'] = $comType;
            $this->save($data);
        } else {
            // get original data
            $new_multiple_attributes = $bannerImage->other_attributes;

            // contains all the inputs from the form as an array
            $input_multiple_attributes = isset($data['other_attributes']) ? $data['other_attributes'] : null;

            // loop over the product array
            if ($input_multiple_attributes) {
                foreach ($input_multiple_attributes as $field => $inputData) {
                    $new_multiple_attributes[$field] = $inputData;
                }
            }
            $data['other_attributes'] = $new_multiple_attributes;
            $bannerImage->update($data);
        }
        return Response('Banner Image update successfully!!');
    }

}
