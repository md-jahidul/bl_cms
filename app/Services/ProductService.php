<?php

namespace App\Services;

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
    protected $productDetailRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $productRepository
     * @param ProductDetailRepository $productDetailRepository
     */
    public function __construct(ProductRepository $productRepository, ProductDetailRepository $productDetailRepository)
    {
        $this->productRepository = $productRepository;
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
    public function updateProduct($data, $id)
    {
        $product = $this->findOne($id);
        $data['show_in_home'] = (isset($data['show_in_home']) ? 1 : 0);
        $product->update($data);
        return Response('Product update successfully !');
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
}
