<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Repositories\PartnerOfferRepository;
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

    /**
     * PartnerOfferService constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->setActionRepository($productRepository);
    }


    /**
     * @param $data
     * @return Response
     */
    public function storeProduct($data, $simId)
    {
        $data['sim_category_id'] = $simId;
        $data['code'] = rand(10000, 12345);
        $this->save($data);
        return new Response('Product added successfully');
    }

    public function tableSortable($data)
    {
        $this->productRepository->productOfferTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateProduct($data, $id)
    {
        $product = $this->findOne($id);
        $data['show_in_home'] = (isset($data['show_in_home']) ? 1 : 0 );
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
