<?php

namespace App\Services\Assetlite;

//use App\Repositories\AppServiceProductegoryRepository;

use App\Repositories\AppServiceProductDetailsRepository;
use App\Repositories\BannerImgRelatedProductRepository;
use App\Repositories\ComponentRepository;
use App\Repositories\ProductDetailsSectionRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BannerImgRelatedProductService
{
    use CrudTrait;
    use FileTrait;
    /**
     * @var $productDetailsSectionRepository
     */
    protected $bannerImgRelatedProductRepository;


    /**
     * ProductDetailsSectionService constructor.
     * @param BannerImgRelatedProductRepository $bannerImgRelatedProductRepository
     */
    public function __construct(BannerImgRelatedProductRepository $bannerImgRelatedProductRepository)
    {
        $this->bannerImgRelatedProductRepository = $bannerImgRelatedProductRepository;
        $this->setActionRepository($bannerImgRelatedProductRepository);
    }

    public function findBannerAndRelatedProduct($productId)
    {
        return $this->bannerImgRelatedProductRepository->findOneByProperties(['product_id' => $productId]);
    }


    public function storeImgProduct($data, $productId)
    {
        if (!empty($data['banner_image_url'])) {
            //delete old web photo
            if ($data['old_web_img'] != "") {
                $this->deleteFile($data['old_web_img']);
            }
            $photoName = $data['banner_name'] . '-web';
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/product_details', $photoName);
        }

        if (!empty($data['mobile_view_img_url'])) {
            //delete old web photo
            if ($data['old_mob_img'] != "") {
                $this->deleteFile($data['old_mob_img']);
            }
            $photoName = $data['banner_name'] . '-mobile';
            $data['mobile_view_img_url'] = $this->upload($data['mobile_view_img_url'], 'assetlite/images/banner/product_details', $photoName);
        }

        //only rename
        if ($data['old_banner_name'] != $data['banner_name']) {
            if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
                $fileName = $data['banner_name'] . '-web';
                $directoryPath = 'assetlite/images/banner/product_details';
                $data['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
            }
            if (empty($data['mobile_view_img_url']) && $data['old_mob_img'] != "") {
                $fileName = $data['banner_name'] . '-mobile';
                $directoryPath = 'assetlite/images/banner/product_details';
                $data['mobile_view_img_url'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
            }
        }

        unset($data['old_web_img']);
        unset($data['old_mob_img']);
        unset($data['old_banner_name']);

        $data['product_id'] = $productId;

        $this->bannerImgRelatedProductRepository->updateOrCreate($data, $productId);
        return response('Banner Image and related product save');
    }

}
