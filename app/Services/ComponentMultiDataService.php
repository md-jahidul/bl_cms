<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\ComponentMultiDataRepository;
use App\Repositories\PrizeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ComponentMultiDataService
{
    use CrudTrait;

    /**
     * @var ComponentMultiDataRepository
     */
    private $componentMultiDataRepository;

    /**
     * AboutPageService constructor.
     * @param ComponentMultiDataRepository $componentMultiDataRepository
     */
    public function __construct(ComponentMultiDataRepository $componentMultiDataRepository)
    {
        $this->componentMultiDataRepository = $componentMultiDataRepository;
        $this->setActionRepository($componentMultiDataRepository);
    }

    /**
     * @param $imgName
     * @return mixed
     */
    public function findComMultiDataOne($imgName)
    {
        return $this->componentMultiDataRepository->findDataOne($imgName);
    }
}
