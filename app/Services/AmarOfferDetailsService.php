<?php

namespace App\Services;

use App\Repositories\AmarOfferDetailsRepository;
use App\Repositories\MenuRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class AmarOfferDetailsService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $menuRepository
     */
    protected $amarOfferDetailsRepository;

    protected const BANNER_IMAGE = "banner_image";

    /**
     * AmarOfferDetailsService constructor.
     * @param AmarOfferDetailsRepository $amarOfferDetailsRepository
     */
    public function __construct(AmarOfferDetailsRepository $amarOfferDetailsRepository)
    {
        $this->amarOfferDetailsRepository = $amarOfferDetailsRepository;
        $this->setActionRepository($amarOfferDetailsRepository);
    }

    public function amarOfferDetailsList()
    {
        return $this->amarOfferDetailsRepository->findIn('type', array('internet', 'voice', 'bundle'));
    }

    public function bannerImageUpload($data)
    {
        $amarOffer = $this->amarOfferDetailsRepository->findOneByProperties(['type' => self::BANNER_IMAGE]);
        if (!empty($data['banner_image_url'])) {
            //delete old web photo
//            if ($data['old_web_img'] != "") {
//                $this->deleteFile($data['old_web_img']);
//            }
//            $photoName = $data['banner_name'] . '-web';
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/amar_offer');
        }

        if (!empty($data['banner_mobile_view'])) {
            //delete old web photo
//            if ($data['old_mob_img'] != "") {
//                $this->deleteFile($data['old_mob_img']);
//            }
//            $photoName = $data['banner_name'] . '-mobile';
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], 'assetlite/images/banner/amar_offer');
        }

        //only rename
//        if ($data['old_banner_name'] != $data['banner_name']) {
//            if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
//                $fileName = $data['banner_name'] . '-web';
//                $directoryPath = 'assetlite/images/banner/amar_offer';
//                $data['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
//            }
//            if (empty($data['banner_mobile_view']) && $data['old_mob_img'] != "") {
//                $fileName = $data['banner_name'] . '-mobile';
//                $directoryPath = 'assetlite/images/banner/amar_offer';
//                $data['banner_mobile_view'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
//            }
//        }

//        unset($data['old_web_img']);
//        unset($data['old_mob_img']);
//        unset($data['old_banner_name']);

        if (!$amarOffer) {
            $data['type'] = self::BANNER_IMAGE;
            $this->save($data);
            return response("Update amar offer banner image");
        } else {
            $amarOffer->update($data);
            return response("Update amar offer banner image");
        }
    }

    public function findByType($type)
    {
        return $this->amarOfferDetailsRepository->findOneByProperties(['type' => $type]);
    }

}
