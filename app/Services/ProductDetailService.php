<?php

namespace App\Services;

use App\Models\OtherRelatedProduct;
use App\Models\RelatedProduct;
use App\Repositories\PartnerOfferDetailRepository;
use App\Repositories\ProductDetailRepository;
use App\Traits\CrudTrait;


class ProductDetailService
{
    use CrudTrait;

    /**
     * @var $partnerOfferDetailRepository
     */
    protected $productDetailRepository;

    /**
     * PartnerOfferDetailService constructor.
     * @param PartnerOfferDetailRepository $partnerOfferDetailRepository
     */
    public function __construct(ProductDetailRepository $productDetailRepository)
    {
        $this->productDetailRepository = $productDetailRepository;
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
        if (count($products) > 0)
        {
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

}
