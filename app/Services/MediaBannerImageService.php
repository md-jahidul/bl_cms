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
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
        }
        if (request()->has('banner_mobile_view')) {
            $data['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
        }

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
