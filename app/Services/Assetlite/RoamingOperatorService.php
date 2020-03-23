<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessInternetRepository;
use App\Repositories\RoamingOperatorRepository;
use App\Repositories\TagCategoryRepository;
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
     * Get Internet package by id
     * @return Response
     */
    public function getInternetById($internetId) {
        $response = $this->internetRepo->getInternetById($internetId);
        return $response;
    }

    /**
     * Get Internet package for drop down
     * @return Response
     */
    public function getAllPackage($internetId = 0) {
        $response = $this->internetRepo->getAllPackage($internetId);
        return $response;
    }

    /**
     * Get tags
     * @return Response
     */
    public function getTags() {
        $response = $this->tagsRepo->getTags();
        return $response;
    }

    /**
     * Save internet package
     * @return Response
     */
    public function saveOperator($request) {
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
    public function updateOperator($request, $id)
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
