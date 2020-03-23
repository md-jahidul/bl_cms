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
        $bannerImage = $this->bannerImgRelatedProductRepository->findOneByProperties(['product_id' => $productId]);
        if (request()->hasFile('banner_image_url')) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/product_details');
            $imgUrl = isset($bannerImage->banner_image_url) ? $bannerImage->banner_image_url : null;
            $this->deleteFile($imgUrl);
        }
        if (request()->hasFile('mobile_view_img_url')) {
            $data['mobile_view_img_url'] = $this->upload($data['mobile_view_img_url'], 'assetlite/images/banner/product_details');
            $imgUrl = isset($bannerImage->mobile_view_img_url) ? $bannerImage->mobile_view_img_url : null;
            $this->deleteFile($imgUrl);
        }
        $data['product_id'] = $productId;

        $this->bannerImgRelatedProductRepository->updateOrCreate($data, $productId);
        return response('Banner Image and related product save');
    }

}
