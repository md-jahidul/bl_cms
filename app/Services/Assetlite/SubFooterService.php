<?php

namespace App\Services\Assetlite;

use App\Http\Resources\BusinessTypeResource;
use App\Repositories\SubFooterRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Exception;

/**
 * Class SubFooterService
 * @package App\Services
 */
class SubFooterService
{
    use CrudTrait;
    /**
     * @var SubFooterRepository
     */
    protected $subFooterRepository;


    /**
     * BannerService constructor.
     * @param SubFooterRepository $bannerRepository
     */
    public function __construct(SubFooterRepository $subFooterRepository)
    {
        $this->subFooterRepository = $subFooterRepository;
        $this->setActionRepository($subFooterRepository);
    }


    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateSubFooter($data, $id)
    {
        $subFooter = $this->findOne($id);
        $subFooter->update($data);
        return Response('Sub Footer updated successfully !');
    }

    /**
     * @param $id
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function deleteBusinessType($id)
    {
        $buinessType = $this->findOne($id);
        $buinessType->delete();
        return Response('Business Types deleted successfully !');
    }


}
