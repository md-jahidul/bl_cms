<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqRepository;
use App\Repositories\LeadProductPermissionRepository as LPPRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LeadProductPermissionService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $alFaqRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * DigitalServicesService constructor.
     * @param LPPRepository $leadProductPermissionRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        LPPRepository $leadProductPermissionRepository,
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productRepository = $productRepository;
        $this->setActionRepository($leadProductPermissionRepository);
    }



    public function getCatAndProducts()
    {
        return $this->alFaqRepository->findByProperties();
    }
}
