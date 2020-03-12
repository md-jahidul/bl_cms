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
     * Get Internet package for drop down
     * @return Response
     */
    public function getAllPackage() {
        $response = $this->internetRepo->getAllPackage();
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
                'product_name' => 'required',
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
     * Upload/Save excel file
     * @return Response
     */
    public function saveExcel($request) {
        $response = $this->internetRepo->saveExcelFile($request);
        return $response;
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
        $response = $this->internetRepo->deletePackage($packageId);
        return $response;
    }

}
