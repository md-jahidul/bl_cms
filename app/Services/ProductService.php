<?php

namespace App\Services;

use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class ProductService
{
    use CrudTrait;


    /**
     * @var $partnerOfferRepository
     */
    protected $productRepository;
    protected $productCoreRepository;
    protected $productDetailRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param ProductDetailRepository $productDetailRepository
     * @param ProductCoreRepository $productCoreRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductDetailRepository $productDetailRepository,
        ProductCoreRepository $productCoreRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productCoreRepository = $productCoreRepository;
        $this->productDetailRepository = $productDetailRepository;
        $this->setActionRepository($productRepository);
    }

    /**
     * @param $data
     * @param $simId
     * @return Response
     */
    public function storeProduct($data, $simId)
    {
//        dd($data);
        $data['sim_category_id'] = $simId;
        $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
        $productId = $this->save($data);
        $this->productDetailRepository->insertProductDetail($productId->id);
        return new Response('Product added successfully');
    }

    public function tableSortable($data)
    {
        $this->productRepository->productOfferTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findRelatedProduct($type, $id)
    {
        return $this->productRepository->relatedProducts($type, $id);
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateProduct($data, $type, $id)
    {
        $product = $this->productRepository->findByCode($type, $id);
        $data['show_in_home'] = (isset($data['show_in_home']) ? 1 : 0);
        $product->update($data);
        return Response('Product update successfully !');
    }

    /**
     * @param $type
     * @param $id
     * @return mixed
     */
    public function findProduct($type, $id)
    {
        return $this->productRepository->findByCode($type, $id);
    }

    public function detailsProduct($id)
    {
        return $this->productRepository->productDetails($id);
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteProduct($id)
    {
        $product = $this->findOne($id);
        $product->delete();
        return Response('Product delete successfully');
    }


    /**
     * @param $data
     * @param $offerId
     * Mapping Product Core Data to Product and insert
     */
    public function insertProduct($data, $offerId)
    {
        $this->save([
            'product_code' => $data['product_code'] ?? null,
            'name_en' => $data['commercial_name_en'] ?? "N/A",
            'name_bn' => $data['commercial_name_bn'] ?? "N/A",
            'ussd_bn' => $data['activation_ussd'] ?? null,
            'sim_category_id' => $data['sim_type'] ?? null,
            'offer_category_id' => $offerId ?? null,
            'is_recharge' => $data['is_recharge_offer'] ?? null,
            'status' => $data['status'],
//            'offer_info' => [
//                'duration_category_id' =>
//            ]
        ]);
    }

    /**
     * @param $coreProduct
     * Check Offer Type and separate product insert method call
     */
    public function getOfferInfo($coreProduct)
    {
        $type = $coreProduct->content_type;
        switch ($type) {
            case 'data':
                $offerId = 1; // Internet Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
            case 'voice':
                $offerId = 2; // Voice Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
            case 'mix':
                $offerId = 3; // Bundle Offer
                $this->insertProduct($coreProduct, $offerId);
                break;
        }
    }


    public function coreData()
    {
        $coreData = $this->productCoreRepository->findAll();
        foreach ($coreData as $coreProduct) {
            $this->getOfferInfo($coreProduct);
        }
        return "Insert Success";
    }

}
