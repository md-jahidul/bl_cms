<?php

namespace App\Services\Assetlite;

use App\Http\Resources\BusinessTypeResource;
use App\Repositories\BusinessTypeRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Exception;

/**
 * Class BusinessTypeService
 * @package App\Services
 */
class BusinessTypeService
{
    use CrudTrait;
    /**
     * @var BusinessTypeRepository
     */
    protected $businessTypeRepository;


    /**
     * BannerService constructor.
     * @param BusinessTypeRepository $bannerRepository
     */
    public function __construct(BusinessTypeRepository $businessTypeRepository)
    {
        $this->businessTypeRepository = $businessTypeRepository;
        $this->setActionRepository($businessTypeRepository);
    }

    /**
     * Storing the slider resource
     * @return Response
     */
    public function storeBusinessType($data)
    {
        $businessTypes = $this->findAll();
        $data['display_order'] = $businessTypes->count() + 1;
        $this->save($data);
        return new Response('Business Types added successfully');
    }

    /**
     * @param $data
     * @param $id
     * @return ResponseFactory|Response
     */
    public function updateBusinessType($data, $id)
    {
        $businessType = $this->findOne($id);
        $businessType->update($data);
        return Response('Business Types updated successfully !');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tableSortable($position)
    {
        $this->businessTypeRepository->sortData($position);
        return new Response('update successfully');
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
