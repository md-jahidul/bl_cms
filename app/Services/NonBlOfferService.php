<?php

namespace App\Services;

use App\Traits\CrudTrait;
use App\Repositories\NonBlOfferRepository;

class NonBlOfferService
{
    use CrudTrait;

    /**
     * @var NonBlOfferRepository
     */
    private $nonBlOfferRepository;

    public function __construct(
        NonBlOfferRepository $nonBlOfferRepository
    ) {
        $this->nonBlOfferRepository = $nonBlOfferRepository;
        $this->setActionRepository($this->nonBlOfferRepository);
    }
}
