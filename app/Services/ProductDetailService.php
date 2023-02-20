<?php

namespace App\Services;

use App\Models\OtherRelatedProduct;
use App\Models\RelatedProduct;
use App\Models\ProductDetail;
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
        ProductDetailRepository $productDetailRepository, ProductRepository $productRepository
    )
    {
        $this->productDetailRepository = $productDetailRepository;
        $this->productRepository = $productRepository;
        $this->setActionRepository($productDetailRepository);
    }

    public function findOneDetails($id)
    {
        return $this->productDetailRepository->findOneByProperties(['product_id' => $id], ['url_slug', 'schema_markup', 'page_header']);
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
        try {
            $status = true;
            $productDetails = $this->productDetailRepository->findOneByProperties(['product_id' => $productId]);
//            $update = [];
//            $data['offer_details_en'] = $data['offer_details_en'];
//            $data['offer_details_bn'] = $data['offer_details_bn'];
//            $data['banner_name'] = $data['banner_name'];

//            if (!empty($data['banner_image_url'])) {
//                //delete old web photo
//                if ($data['old_web_img'] != "") {
//                    $this->deleteFile($data['old_web_img']);
//                }
//                $photoName = $data['banner_name'] . '-web';
//                $data['banner_image_url'] = $this->upload($data['banner_image_url'], 'assetlite/images/banner/product_details', $photoName);
//                $status = $data['banner_image_url'];
//            }
//
//            if (!empty($data['banner_image_mobile'])) {
//                //delete old web photo
//                if ($data['old_mob_img'] != "") {
//                    $this->deleteFile($data['old_mob_img']);
//                }
//                $photoName = $data['banner_name'] . '-mobile';
//                $data['banner_image_mobile'] = $this->upload($data['banner_image_mobile'], 'assetlite/images/banner/product_details', $photoName);
//                $status = $data['banner_image_mobile'];
//            }

            //only rename
//            if ($data['old_banner_name'] != $data['banner_name']) {
//                //rename web
//                if (empty($data['banner_image_url']) && $data['old_web_img'] != "") {
//                    $fileName = $data['banner_name'] . '-web';
//                    $directoryPath = 'assetlite/images/banner/product_details';
//                    $data['banner_image_url'] = $this->rename($data['old_web_img'], $fileName, $directoryPath);
//
//                    $status = $data['banner_image_url'];
//                }
//
//                if (empty($data['banner_image_mobile']) && $data['old_mob_img'] != "") {
//                    $fileName = $data['banner_name'] . '-mobile';
//                    $directoryPath = 'assetlite/images/banner/product_details';
//                    $data['banner_image_mobile'] = $this->rename($data['old_mob_img'], $fileName, $directoryPath);
//
//                    $status = $data['banner_image_mobile'];
//                }
//            }

            if ($status != false) {
                $bondhoSimOffers = $this->productRepository->countBondhoSimOffer();

                if (isset($data['other_offer_type_id'])) {
                    foreach ($bondhoSimOffers as $bondhoSimOffer) {
                        if ($bondhoSimOffer->offer_info['other_offer_type_id'] == 13) {
                            $productDetails = $this->productDetailRepository->findOneByProperties(['product_id' => $bondhoSimOffer->id]);
//                             $this->productDetailRepository->saveProductDetails($update, $bondhoSimOffer->id);
                            $productDetails->update($data);
                        }
                    }
                }

                if (isset($data['other_attributes']['extra_validity_details_en'])
                    && $data['other_attributes']['extra_validity_details_en'] == "<p><br></p>") {
                    $data['other_attributes']['extra_validity_details_en'] = null;
                }

                if (isset($data['other_attributes']['extra_validity_details_bn'])
                    && $data['other_attributes']['extra_validity_details_bn'] == "<p><br></p>") {
                    $data['other_attributes']['extra_validity_details_bn'] = null;
                }

//                $this->productDetailRepository->saveProductDetails($update, $productId);
                $productDetails->update($data);
                $response = [
                    'success' => 1,
                ];
            } else {
                $response = [
                    'success' => 2,
                ];
            }
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

}
