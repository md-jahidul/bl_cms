<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\AboutUsLandingRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AboutUsLandingService
{
    use CrudTrait;
    /**
     * @var AboutUsLandingRepository
     */
    private $aboutUsLandingRepository;

    /**
     * AboutUsLandingService constructor.
     * @param AboutUsLandingRepository $aboutUsLandingRepository
     */
    public function __construct(AboutUsLandingRepository $aboutUsLandingRepository)
    {
        $this->aboutUsLandingRepository = $aboutUsLandingRepository;
        $this->setActionRepository($aboutUsLandingRepository);
    }
}
