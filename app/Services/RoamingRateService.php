<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingRateRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoamingRateService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var RoamingRateRepository
     */
    private $roamingRateRepository;

    /**
     * BusinessInternetService constructor.
     * @param RoamingRateRepository $roamingRateRepository
     */
    public function __construct(RoamingRateRepository $roamingRateRepository)
    {
        $this->roamingRateRepository = $roamingRateRepository;
        $this->setActionRepository($roamingRateRepository);
    }

    /**
     * Get Internet package
     * @return array
     */
    public function getRoamingRates($request)
    {
        return $this->roamingRateRepository->getRateList($request);
    }

//    /**
//     * Get Internet package by id
//     * @return Response
//     */
//    public function getInternetById($internetId) {
//        $response = $this->roamingRateRepository->getInternetById($internetId);
//        return $response;
//    }
//
//    /**
//     * Get Internet package for drop down
//     * @return Response
//     */
//    public function getAllPackage($internetId = 0) {
//        $response = $this->roamingRateRepository->getAllPackage($internetId);
//        return $response;
//    }

    /**
     * Save internet package
     * @return Response
     */
    public function saveRate($request) {
        try {
            $request->validate([
                'country_en' => 'required',
                'country_bn' => 'required',
                'operator_en' => 'required',
                'operator_bn' => 'required',
                'tap_code' => 'required',
            ]);
            $this->save($request->all());
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
     * @param $request
     * @return array
     */
    public function updateRate($request, $id)
    {
        try {
            $request->validate([
                'country_en' => 'required',
                'country_bn' => 'required',
                'operator_en' => 'required',
                'operator_bn' => 'required',
                'tap_code' => 'required',
            ]);
            $operator = $this->findOne($id);
            $operator->update($request->all());
            $response = [
                'success' => 1,
            ];
            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e
            ];
            return $response;
        }
    }

    /**
     * Upload/Save excel file
     * @param $request
     * @return JsonResponse
     */
    public function saveExcel($request)
    {
        return $this->roamingRateRepository->saveExcelFile($request);
    }

    /**
     * change showing status
     * @return Response
     */
    public function statusChange($id)
    {
        return $this->roamingRateRepository->statusChange($id);
    }

    /**
     * Delete Internet package
     * @param $operatorId
     * @return JsonResponse
     */
    public function deleteRate($operatorId)
    {
        return $this->roamingRateRepository->deleteRate($operatorId);
    }

}
