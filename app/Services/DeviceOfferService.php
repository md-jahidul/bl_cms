<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 05/01/2020
 */

namespace App\Services;

use App\Repositories\DeviceOfferRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class DeviceOfferService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $deviceOfferRepository;

    /**
     * DeviceOfferService constructor.
     * @param DeviceOfferRepository $deviceOfferRepository
     */
    public function __construct(DeviceOfferRepository $deviceOfferRepository)
    {
        $this->deviceOfferRepository = $deviceOfferRepository;
        $this->setActionRepository($deviceOfferRepository);
    }

    /**
     * Get grouped division names for filter
     * @return Response
     */
    public function getBrands()
    {
        $response = $this->deviceOfferRepository->getBrandList();
        return $response;
    }
    
    /**
     * Get grouped division names for filter
     * @return Response
     */
    public function getDeviceOffers($request)
    {
        $response = $this->deviceOfferRepository->getDeviceOfferList($request);
        return $response;
    }
    
    
    /**
     * Upload/Save excel file
     * @return Response
     */
    public function saveExcel($request)
    {
        $response = $this->deviceOfferRepository->saveExcelFile($request);
        return $response;
    }
    
    
    /**
     * Change status
     * @return Response
     */
    public function statusChange($offerId)
    {
        $response = $this->deviceOfferRepository->statusChange($offerId);
        return $response;
    }
    
    /**
     * Delete Payment Card
     * @return Response
     */
    public function deleteOffer($offerId)
    {
        $response = $this->deviceOfferRepository->deleteOffer($offerId);
        return $response;
    }
    
    
    
    

   
}
