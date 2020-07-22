<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\AlFaqCategoryRepository;
use App\Repositories\AlFaqRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlFaqCategoryService
{
    use CrudTrait;
    /**
     * @var AlFaqCategoryRepository
     */
    private $alFaqCategoryRepository;

    /**
     * DigitalServicesService constructor.
     * @param AlFaqCategoryRepository $alFaqCategoryRepository
     */
    public function __construct(AlFaqCategoryRepository $alFaqCategoryRepository)
    {
        $this->alFaqCategoryRepository = $alFaqCategoryRepository;
        $this->setActionRepository($alFaqCategoryRepository);
    }
}
