<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\MediaBannerImageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;

class MediaBannerImageService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $mediaBannerImageRepository;

    /**
     * AboutPageService constructor.
     * @param MediaBannerImageRepository $mediaBannerImageRepository
     */
    public function __construct(MediaBannerImageRepository $mediaBannerImageRepository)
    {
        $this->mediaBannerImageRepository = $mediaBannerImageRepository;
        $this->setActionRepository($mediaBannerImageRepository);
    }

    public function getBannerImage($moduleType)
    {
        return $this->mediaBannerImageRepository
            ->findOneByProperties(['module_type' => $moduleType]);
    }

    public function bannerImageUpload($data, $type)
    {
        $bannerImage = $this->getBannerImage($type);

        $dirPath = 'assetlite/images/banner/media';
        if (request()->has('banner_image_url')) {
            $moduleWiseData['press_release']['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
        }
        if (request()->has('banner_mobile_view')) {
            $moduleWiseData['press_release']['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
        }

        if (request()->has('news_news_banner_image_url')) {
            $moduleWiseData['news_event']['banner_image_url'] = $this->upload($data['news_news_banner_image_url'], $dirPath);
        }
        if (request()->has('news_banner_mobile_view')) {
            $moduleWiseData['news_event']['news_banner_mobile_view'] = $this->upload($data['news_banner_mobile_view'], $dirPath);
        }
//        $moduleWiseData['news_event'] = $data['news_alt_text_en']

        dd($moduleWiseData);

        if (!$bannerImage) {
            $data['module_type'] = $type;
            $data['created_by'] = Auth::id();
            $this->save($data);
        } else {
            $data['updated_by'] = Auth::id();
            $bannerImage->update($data);
        }
        return Response('Banner Image has been successfully updated');
    }
}
