<?php

namespace App\Services;

use App\Models\OtherRelatedProduct;
use App\Models\RelatedProduct;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class ProductDetailService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $partnerOfferDetailRepository
     */
    protected $productDetailRepository;

    protected $productRepository;

    /**
     * ProductDetailService constructor.
     * @param ProductDetailRepository $productDetailRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductDetailRepository $productDetailRepository,
        ProductRepository $productRepository
    ) {
        $this->productDetailRepository = $productDetailRepository;
        $this->productRepository = $productRepository;
        $this->setActionRepository($productDetailRepository);
    }


    /**
     * @param $request
     * @param $id
     */
    public function updateOtherRelatedProduct($request, $id)
    {

        $otherRelatedProducts = OtherRelatedProduct::where('product_id', $id)->get();
        if (count($otherRelatedProducts) > 0) {
            foreach ($otherRelatedProducts as $product) {
                $productId = OtherRelatedProduct::findOrFail($product->id);
                $productId->delete();
            }
        }

        if (isset(request()->other_related_product_id)) {
            foreach (request()->other_related_product_id as $item) {
                OtherRelatedProduct::create([
                    'product_id' => $id,
                    'other_offer_id' => $request->other_offer_type_id,
                    'related_product_id' => $item
                ]);
            }
        }
    }

    /**
     * @param $requset
     * @param $id
     */
    public function updateRelatedProduct($requset, $id)
    {
        $products = RelatedProduct::where('product_id', $id)->get();
        if (count($products) > 0) {
            foreach ($products as $product) {
                $productId = RelatedProduct::findOrFail($product->id);
                $productId->delete();
            }
        }

        if (isset(request()->related_product_id)) {
            foreach (request()->related_product_id as $item) {
                RelatedProduct::create([
                    'product_id' => $id,
                    'related_product_id' => $item
                ]);
            }
        }
    }

    /**
     * @param $data
     * @param $productId
     * @return ResponseFactory|Response
     */
    public function updateProductDetails($data, $productId)
    {
        $productDetails = $this->productDetailRepository->findOneByProperties(['product_id' => $productId]);

        if (!empty($data['banner_image_url'])) {
            $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/product_details');
        }

        $bondhoSimOffers = $this->productRepository->countBondhoSimOffer();

        if (isset($data['other_offer_type_id'])) {
            foreach ($bondhoSimOffers as $bondhoSimOffer) {
                if ($bondhoSimOffer->offer_info['other_offer_type_id'] == 13) {
                    $productDetails = $this->productDetailRepository->findOneByProperties(['product_id' => $bondhoSimOffer->id]);
                    $productDetails->update($data);
                }
            }
        }

        $productDetails->update($data);
        return Response('Product Details update successfully!');
    }

}
