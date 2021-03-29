<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Repositories\AboutPageRepository;
use App\Repositories\PrizeRepository;
use App\Repositories\ProductActivityRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class ProductActivityService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPageRepository;
    /**
     * @var ProductActivityRepository
     */
    private $productActivityRepository;

    /**
     * AboutPageService constructor.
     * @param ProductActivityRepository $productActivityRepository
     */
    public function __construct(ProductActivityRepository $productActivityRepository)
    {
        $this->productActivityRepository = $productActivityRepository;
        $this->setActionRepository($productActivityRepository);
    }

    /**
     * @param $data
     * @param $fileLocation
     * @return ResponseFactory|Response
     */
    public function aboutPageUpdate($data, $fileLocation)
    {
        $aboutDetail = $this->aboutPageRepository->findDetail($data['slug']);
        if ($aboutDetail != null) {

        } else {
            return Response('About page not found');
        }
    }

}
