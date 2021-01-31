<?php

namespace App\Services;

use App\Repositories\ProductTagRepository;
use App\Traits\CrudTrait;

class ProductTagService
{
    use CrudTrait;

    /**
     * @var ProductTagRepository
     */
    private $productTagRepository;

    /**
     * ProductTagService constructor.
     * @param ProductTagRepository $productTagRepository
     */
    public function __construct(ProductTagRepository $productTagRepository)
    {
        $this->productTagRepository = $productTagRepository;
        $this->setActionRepository($productTagRepository);
    }


}
