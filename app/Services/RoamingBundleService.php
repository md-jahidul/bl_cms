<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingBundleRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;


class RoamingBundleService
{
    use CrudTrait;
    use FileTrait;

    /**
     * @var RoamingBundleRepository
     */
    private $roamingBundleRepository;

    /**
     * BusinessInternetService constructor.
     * @param RoamingBundleRepository $roamingBundleRepository
     */
    public function __construct(RoamingBundleRepository $roamingBundleRepository)
    {
        $this->roamingBundleRepository = $roamingBundleRepository;
        $this->setActionRepository($roamingBundleRepository);
    }

    /**
     * Get Internet package
     * @return array
     */
    public function getRoamingBundle($request)
    {
        return $this->roamingBundleRepository->getBundleList($request);
    }

//    /**
//     * Get Internet package by id
//     * @return Response
//     */
//    public function getInternetById($internetId) {
//        $response = $this->roamingBundleRepository->getInternetById($internetId);
//        return $response;
//    }
//
//    /**
//     * Get Internet package for drop down
//     * @return Response
//     */
//    public function getAllPackage($internetId = 0) {
//        $response = $this->roamingBundleRepository->getAllPackage($internetId);
//        return $response;
//    }

    /**
     * Save internet package
     * @return array
     */
    public function saveBundle($request) {
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
    public function updateBundle($request, $id)
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
        return $this->roamingBundleRepository->saveExcelFile($request);
    }

    /**
     * change showing status
     * @return JsonResponse
     */
    public function statusChange($id)
    {
        return $this->roamingBundleRepository->statusChange($id);
    }

    /**
     * Delete Internet package
     * @param $operatorId
     * @return JsonResponse
     */
    public function deleteBundle($operatorId)
    {
        return $this->roamingBundleRepository->deleteBundle($operatorId);
    }

}
