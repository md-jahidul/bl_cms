<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\MyblDynamicDeeplinkRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MyblDynamicDeeplinkService
{
    use CrudTrait;

    /**
     * @var MyblDynamicDeeplinkRepository
     */
    private $dynamicDeeplinkRepository;

    /**
     * MyblDynamicDeeplinkService constructor.
     * @param MyblDynamicDeeplinkRepository $dynamicDeeplinkRepository
     */
    public function __construct(MyblDynamicDeeplinkRepository $dynamicDeeplinkRepository)
    {
        $this->dynamicDeeplinkRepository = $dynamicDeeplinkRepository;
        $this->setActionRepository($dynamicDeeplinkRepository);
    }

}
