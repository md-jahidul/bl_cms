<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Repositories\EasyPaymentCardRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class EasyPaymentCardService
{
    use CrudTrait;

    /**
     * @var $sliderRepository
     */
    protected $paymentCardRepository;

    /**
     * DigitalServicesService constructor.
     * @param EasyPaymentCardRepository $paymentCardRepository
     */
    public function __construct(EasyPaymentCardRepository $paymentCardRepository)
    {
        $this->paymentCardRepository = $paymentCardRepository;
        $this->setActionRepository($paymentCardRepository);
    }

    /**
     * Get grouped division names for filter
     * @return Response
     */
    public function getDivisions()
    {
        $divisions = $this->paymentCardRepository->getDivisionList();
        return $divisions;
    }
    
    /**
     * Get grouped division names for filter
     * @return Response
     */
    public function getPaymentCards($request)
    {
        $response = $this->paymentCardRepository->getPaymentCardList($request);
        return $response;
    }
    
    
    /**
     * Upload/Save excel file
     * @return Response
     */
    public function saveExcel($request)
    {
        $response = $this->paymentCardRepository->saveExcelFile($request);
        return $response;
    }
    
    
    /**
     * Change status
     * @return Response
     */
    public function statusChange($cardId)
    {
        $response = $this->paymentCardRepository->statusChange($cardId);
        return $response;
    }
    
    /**
     * Delete Payment Card
     * @return Response
     */
    public function deleteCard($cardId)
    {
        $response = $this->paymentCardRepository->deleteCards($cardId);
        return $response;
    }
    
    
    
    

   
}
