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
        if (request()->hasFile('banner_image_url')) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/product_details');
        }
        $data['product_id'] = $productId;
        $this->bannerImgRelatedProductRepository->updateOrCreate($data, $productId);
        return response('Banner Image and related product save');
    }

}
