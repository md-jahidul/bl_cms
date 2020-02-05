<?php

namespace App\Services;

use App\Repositories\AmarOfferDetailsRepository;
use App\Repositories\MenuRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class AmarOfferDetailsService
{
    use CrudTrait;

    /**
     * @var $menuRepository
     */
    protected $amarOfferDetailsRepository;

    /**
     * AmarOfferDetailsService constructor.
     * @param AmarOfferDetailsRepository $amarOfferDetailsRepository
     */
    public function __construct(AmarOfferDetailsRepository $amarOfferDetailsRepository)
    {
        $this->amarOfferDetailsRepository = $amarOfferDetailsRepository;
        $this->setActionRepository($amarOfferDetailsRepository);
    }

    public function amarOfferDetailsList()
    {
        return $this->findAll();
    }

    public function findByType($type)
    {
        return $this->amarOfferDetailsRepository->findOneByProperties(['type' => $type]);
    }

}
