<?php

namespace App\Services;

use App\Repositories\LmsAboutBannerRepository;
use App\Repositories\MediaBannerImageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LmsAboutBannerService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var LmsAboutBannerRepository
     */
    private $lmsAboutBannerRepository;

    /**
     * AboutPageService constructor.
     * @param LmsAboutBannerRepository $lmsAboutBannerRepository
     */
    public function __construct(LmsAboutBannerRepository $lmsAboutBannerRepository)
    {
        $this->lmsAboutBannerRepository = $lmsAboutBannerRepository;
        $this->setActionRepository($lmsAboutBannerRepository);
    }

    public function getBannerImage($moduleType)
    {
        return $this->mediaBannerImageRepository
            ->findOneByProperties(['module_type' => $moduleType]);
    }

    public function getBannerImgByPageType($pageType)
    {
        return $this->lmsAboutBannerRepository->findOneByProperties(['page_type' => $pageType]);
    }

    /**
     * @param $data
     * @return Application|ResponseFactory|Response
     */
    public function bannerImageUpload($data)
    {
        $dirPath = 'assetlite/images/banner/lms-about';
        if (request()->has('banner_image_url')) {
            $moduleWiseData['about_loyalty']['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
            if ($data['loyalty_web_banner_old'] && $data['banner_image_url']) {
                $this->deleteFile($data['loyalty_web_banner_old']);
            }
        }
        if (request()->has('banner_mobile_view')) {
            $moduleWiseData['about_loyalty']['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
            if ($data['loyalty_mobile_banner_old'] && $data['banner_mobile_view']) {
                $this->deleteFile($data['loyalty_mobile_banner_old']);
            }
        }
        $moduleWiseData['about_loyalty']['title_en'] = $data['title_en'];
        $moduleWiseData['about_loyalty']['title_bn'] = $data['title_bn'];
        $moduleWiseData['about_loyalty']['desc_en'] = $data['desc_en'];
        $moduleWiseData['about_loyalty']['desc_bn'] = $data['desc_bn'];
        $moduleWiseData['about_loyalty']['page_type'] = 'about_loyalty';

//        if (request()->has('reward_banner_image_url')) {
//            $moduleWiseData['about_reward']['banner_image_url'] = $this->upload($data['reward_banner_image_url'], $dirPath);
//            if ($data['reward_web_banner_old'] && $data['reward_banner_image_url']) {
//                $this->deleteFile($data['reward_web_banner_old']);
//            }
//        }
//        if (request()->has('reward_banner_mobile_view')) {
//            $moduleWiseData['about_reward']['banner_mobile_view'] = $this->upload($data['reward_banner_mobile_view'], $dirPath);
//            if ($data['reward_mobile_banner_old'] && $data['reward_banner_mobile_view']) {
//                $this->deleteFile($data['reward_mobile_banner_old']);
//            }
////        }
//        $moduleWiseData['about_reward']['alt_text_en'] = $data['reward_alt_text_en'];
//        $moduleWiseData['about_reward']['page_type'] = 'about_reward';
//        dd($moduleWiseData);
        foreach ($moduleWiseData as $data) {
            $this->lmsAboutBannerRepository->bannerUpload($data);
        }
        return Response('Banner Image has been successfully updated');
    }
}
