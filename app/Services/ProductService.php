<?php

namespace App\Services;

use App\Models\PartnerCategory;
use App\Repositories\PartnerOfferRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
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


    public function itemList($partnerId, $isHome = false)
    {
        return $this->partnerOfferRepository->getPartnerOffer($partnerId, $isHome);
    }

    /**
     * @param $data
     * @return Response
     */
    public function storeProduct($data, $partnerId)
    {

        $count = count($this->productRepository->findAll());
        $data['partner_id'] = $partnerId;
        $data['display_order'] = ++$count;
        $this->save($data);
        return new Response('Partner offer added successfully');
    }

    public function tableSortable($data)
    {
        $this->productRepository->productTableSort($data);
        return new Response('update successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function updateProduct($data, $id)
    {

        $product = $this->findOne($id);
        (isset($data['show_in_home'])) ? $data['show_in_home'] = 1 : $data['show_in_home'] = 0;
        $product->update($data);
        return Response('Partner offer update successfully !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteProduct($id)
    {
        $product = $this->findOne($id);
        $product->delete();
        return Response('Product delete successfully');
    }
}
