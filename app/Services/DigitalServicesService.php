<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\DigitalServiceRepository;
use App\Traits\CrudTrait;

class DigitalServicesService
{
    use CrudTrait;

    /**
     * @var DigitalServiceRepository
     */
    protected $digitalServiceRepository;

    /**
     * DigitalServicesService constructor.
     * @param DigitalServiceRepository $digitalServiceRepository
     */
    public function __construct(DigitalServiceRepository $digitalServiceRepository)
    {
        $this->digitalServiceRepository = $digitalServiceRepository;
        $this->setActionRepository($digitalServiceRepository);
    }
}
