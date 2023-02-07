<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessInternetRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class BusinessInternetService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $internetRepo
     * @var $tagsRepo
     */
    protected $internetRepo;
    protected $tagsRepo;

    /**
     * BusinessInternetService constructor.
     * @param BusinessInternetRepository $internetRepo
     * @param TagCategoryRepository $tagsRepo
     */
    public function __construct(BusinessInternetRepository $internetRepo, TagCategoryRepository $tagsRepo) {
        $this->internetRepo = $internetRepo;
        $this->tagsRepo = $tagsRepo;
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

            //file upload in storege
            $photoNameWeb = $request['banner_name'] . '-web';
            $photoNameMob = $request['banner_name'] . '-mobile';
            $directoryPath = 'assetlite/images/business-images';

            $bannerWeb = "";
            $bannerMob = "";
            if (!empty($request['banner_photo'])) {
                $bannerWeb = $this->upload($request['banner_photo'], $directoryPath, $photoNameWeb);
            }

            if (!empty($request['banner_mobile'])) {
                $bannerMob = $this->upload($request['banner_mobile'], $directoryPath, $photoNameMob);
            }

            $this->internetRepo->saveInternet($bannerWeb, $bannerMob, $request);

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
    public function updateInternet($data) {
        try {

            //file upload in storege

            $photoNameWeb = $data['banner_name'] .time(). '-web';
            $photoNameMob = $data['banner_name'] .time(). '-mobile';
            $directoryPath = 'assetlite/images/business-images';

            $bannerWeb = "";
            $bannerMob = "";
            if (!empty($data['banner_photo'])) {

                $data['old_banner'] != "" ? $this->deleteFile($data['old_banner']) : "";
                $bannerWeb = $this->upload($data['banner_photo'], $directoryPath, $photoNameWeb);
            }

            if (!empty($data['banner_mobile'])) {

                $data['old_banner_mob'] != "" ? $this->deleteFile($data['old_banner_mob']) : "";
                $bannerMob = $this->upload($data['banner_mobile'], $directoryPath, $photoNameMob);
            }

            //only rename
            if ($data['old_banner_name'] != $data['banner_name']) {

                if (empty($data['banner_photo'])) {
                    $bannerWeb = $this->rename($data['old_banner'], $photoNameWeb, $directoryPath);
                }

                if (empty($data['banner_mobile'])) {
                    $bannerMob = $this->rename($data['old_banner_mob'], $photoNameMob, $directoryPath);
                }
            }

            $this->internetRepo->saveInternet($bannerWeb, $bannerMob, $data);

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
