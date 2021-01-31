<?php

namespace App\Services;

use App\Repositories\MediaBannerImageRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
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

    public function tvcBannerUpload($data, $type)
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

    /**
     * @param $data
     * @return Application|ResponseFactory|Response
     */
    public function bannerImageUpload($data)
    {
        $bannerImage = $this->mediaBannerImageRepository->getBannerImage();

        $dirPath = 'assetlite/images/banner/media';
        if (request()->has('banner_image_url')) {
            $moduleWiseData['press_release']['banner_image_url'] = $this->upload($data['banner_image_url'], $dirPath);
        }
        if (request()->has('banner_mobile_view')) {
            $moduleWiseData['press_release']['banner_mobile_view'] = $this->upload($data['banner_mobile_view'], $dirPath);
        }
        $moduleWiseData['press_release']['alt_text_en'] = $data['alt_text_en'];

        $moduleWiseData['press_release']['page_header'] = $data['page_header'];
        $moduleWiseData['press_release']['page_header_bn'] = $data['page_header_bn'];
        $moduleWiseData['press_release']['schema_markup'] = $data['schema_markup'];

        $moduleWiseData['press_release']['alt_text_bn'] = $data['alt_text_bn'];
        $moduleWiseData['press_release']['banner_name_en'] = $data['banner_name_en'];
        $moduleWiseData['press_release']['banner_name_bn'] = $data['banner_name_bn'];

        $moduleWiseData['press_release']['module_type'] = 'press_release';

        if (request()->has('news_news_banner_image_url')) {
            $moduleWiseData['news_event']['banner_image_url'] = $this->upload($data['news_news_banner_image_url'], $dirPath);
        }
        if (request()->has('news_banner_mobile_view')) {
            $moduleWiseData['news_event']['banner_mobile_view'] = $this->upload($data['news_banner_mobile_view'], $dirPath);
        }
        $moduleWiseData['news_event']['alt_text_en'] = $data['news_alt_text_en'];

        $moduleWiseData['news_event']['page_header'] = $data['news_page_header'];
        $moduleWiseData['news_event']['page_header_bn'] = $data['news_page_header_bn'];
        $moduleWiseData['news_event']['schema_markup'] = $data['news_schema_markup'];

        $moduleWiseData['news_event']['alt_text_bn'] = $data['news_alt_text_bn'];
        $moduleWiseData['news_event']['banner_name_en'] = $data['news_banner_name_en'];
        $moduleWiseData['news_event']['banner_name_bn'] = $data['news_banner_name_bn'];

        $moduleWiseData['news_event']['module_type'] = 'news_event';

        foreach ($moduleWiseData as $data) {
            $this->mediaBannerImageRepository->bannerUpload($data);
        }
        return Response('Banner Image has been successfully updated');
    }
}
