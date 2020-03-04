<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessInternetRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class BusinessInternetService {

    use CrudTrait;

    /**
     * @var $internetRepo
     */
    protected $internetRepo;

    /**
     * BusinessInternetService constructor.
     * @param BusinessInternetRepository $internetRepo
     */
    public function __construct(BusinessInternetRepository $internetRepo) {
        $this->internetRepo = $internetRepo;
        $this->setActionRepository($internetRepo);
    }

    /**
     * Get Internet package
     * @return Response
     */
    public function getInternetPackage($request) {
        $response = $this->internetRepo->getInternetPackageList($request);
        return $response;
    }
    
      /**
     * Upload/Save excel file
     * @return Response
     */
    public function saveExcel($request)
    {
        $response = $this->internetRepo->saveExcelFile($request);
        return $response;
    }
      /**
     * change home show
     * @return Response
     */
    public function homeShow($packageId)
    {
        $response = $this->internetRepo->homeShow($packageId);
        return $response;
    }
    
      /**
     * change showing status
     * @return Response
     */
    public function statusChange($packageId)
    {
        $response = $this->internetRepo->statusChange($packageId);
        return $response;
    }
    
    /**
     * Delete Internet package
     * @return Response
     */
    public function deletePackage($packageId)
    {
        $response = $this->internetRepo->deletePackage($packageId);
        return $response;
    }

}
