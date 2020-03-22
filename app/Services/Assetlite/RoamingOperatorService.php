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
    public function saveInternet($request) {
        try {

            $request->validate([
                'product_code' => 'required',
                'product_code_ev' => 'required',
                'product_code_with_renew' => 'required',
                'product_commercial_name_en' => 'required',
                'product_commercial_name_bn' => 'required',
                'product_short_description' => 'required',
                'activation_ussd_code' => 'required',
                'balance_check_ussd_code' => 'required',
                'data_volume' => 'required',
                'volume_data_unit' => 'required',
                'validity' => 'required',
                'validity_unit' => 'required',
                'mrp' => 'required',
                'price' => 'required',
            ]);

            //file upload in storege
            $bannerPath = "";
            if ($request['banner_photo'] != "") {
                $bannerPath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');
            }

            $this->internetRepo->saveInternet($bannerPath, $request);

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
     * Save internet package
     * @return Response
     */
    public function updateInternet($request) {
        try {

            $request->validate([
                'product_code' => 'required',
                'product_code_ev' => 'required',
                'product_code_with_renew' => 'required',
                'product_commercial_name_en' => 'required',
                'product_commercial_name_bn' => 'required',
                'product_short_description' => 'required',
                'activation_ussd_code' => 'required',
                'balance_check_ussd_code' => 'required',
                'data_volume' => 'required',
                'volume_data_unit' => 'required',
                'validity' => 'required',
                'validity_unit' => 'required',
                'mrp' => 'required',
                'price' => 'required',
            ]);

            //file upload in storege
            $bannerPath = "";
            if ($request['banner_photo'] != "") {
                $bannerPath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');
                $this->deleteFile($request['old_banner']);
            }

            $this->internetRepo->saveInternet($bannerPath, $request);

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveExcel($request)
    {
        return $this->roamingOperatorRepository->saveExcelFile($request);
    }

    /**
     * change home show
     * @return Response
     */
    public function homeShow($packageId) {
        $response = $this->internetRepo->homeShow($packageId);
        return $response;
    }

    /**
     * change showing status
     * @return Response
     */
    public function statusChange($packageId) {
        $response = $this->internetRepo->statusChange($packageId);
        return $response;
    }

    /**
     * Delete Internet package
     * @return Response
     */
    public function deletePackage($packageId) {
        $package = $this->internetRepo->getInternetById($packageId);
        $this->deleteFile($package->banner_photo);
        $response = $this->internetRepo->deletePackage($packageId);
        return $response;
    }

}
