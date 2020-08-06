<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingOperatorRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoamingOperatorService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var RoamingOperatorRepository
     */
    private $roamingOperatorRepository;

    /**
     * BusinessInternetService constructor.
     * @param RoamingOperatorRepository $roamingOperatorRepository
     */
    public function __construct(RoamingOperatorRepository $roamingOperatorRepository) {
        $this->roamingOperatorRepository = $roamingOperatorRepository;
        $this->setActionRepository($roamingOperatorRepository);
    }

    /**
     * Get Internet package
     * @return array
     */
    public function getRoamingOperators($request)
    {
        return $this->roamingOperatorRepository->getOperatorList($request);
    }



    /**
     * @param $request
     * @return array
     */
    public function updateOperator($request)
    {
        try {
            $request->validate([
                'country_en' => 'required',
                'operator_en' => 'required'
            ]);
            
            $this->roamingOperatorRepository->saveOperator($request);
            
            $response = [
                'success' => 1,
            ];
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    /**
     * Upload/Save excel file
     * @return JsonResponse
     */
    public function saveExcel($request)
    {
        return $this->roamingOperatorRepository->saveExcelFile($request);
    }

    /**
     * change showing status
     * @return Response
     */
    public function statusChange($id)
    {
        $response = $this->roamingOperatorRepository->statusChange($id);
        return $response;
    }

    /**
     * Delete Internet package
     * @param $operatorId
     * @return JsonResponse
     */
    public function deleteOperator($operatorId)
    {
        return $this->roamingOperatorRepository->deleteOperator($operatorId);
    }

}
