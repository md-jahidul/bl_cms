<?php

namespace App\Services;

use App\Repositories\ProductCoreRepository;
use App\Repositories\ProductDetailRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;


class ProductCoreService
{
    use CrudTrait;

    /**
     * @var $partnerOfferRepository
     */
    protected $productCoreRepository;

    /**
     * ProductCoreService constructor.
     * @param ProductCoreRepository $productCoreRepository
     */
    public function __construct(ProductCoreRepository $productCoreRepository)
    {
        $this->productCoreRepository = $productCoreRepository;
        $this->setActionRepository($productCoreRepository);
    }

    /**
     * @param $data
     * @param $simId
     * @return Response
     */
    public function storeProductCore($data)
    {
        return $this->productCoreRepository->insertProductCore($data);
    }

}
