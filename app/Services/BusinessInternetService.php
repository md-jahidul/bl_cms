<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Helpers\BaseURLLocalization;
use App\Repositories\BusinessInternetRepository;
use App\Repositories\TagCategoryRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\JsonResponse;
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
     * @return int[]
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

            $businessInternet = $this->internetRepo->saveInternet($bannerWeb, $bannerMob, $request);
            $this->_saveSearchData($businessInternet);

            return [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    private function _saveSearchData($product)
    {
        $feature = BaseURLLocalization::featureBaseUrl();
        // URL make
        $urlEn = $feature["business_en"] . "internet" . '/' . $product->url_slug;
        $urlBn = $feature["business_bn"] . "internet" . '/' . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => null,
            'type' => 'business-internet',
            'page_title_en' => $product->product_commercial_name_en,
            'page_title_bn' => $product->product_commercial_name_bn,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => $product->status ?? 1,
        ];

        if ($product->searchableFeature()->first()) {
            $product->searchableFeature()->update($saveSearchData);
        } else {
            $product->searchableFeature()->create($saveSearchData);
        }
    }

    /**
     * Save internet package
     * @return int[]
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

//                $data['old_banner'] != "" ? $this->deleteFile($data['old_banner']) : "";
                $bannerWeb = $this->upload($data['banner_photo'], $directoryPath, $photoNameWeb);
            }

            if (!empty($data['banner_mobile'])) {
                $data['old_banner_mob'] != "" ? $this->deleteFile($data['old_banner_mob']) : "";
                $bannerMob = $this->upload($data['banner_mobile'], $directoryPath, $photoNameMob);
            }

            //only rename
//            if ($data['old_banner_name'] != $data['banner_name']) {
//                if (empty($data['banner_photo'])) {
//                    $bannerWeb = $this->rename($data['old_banner'], $photoNameWeb, $directoryPath);
//                }
//                if (empty($data['banner_mobile'])) {
//                    $bannerMob = $this->rename($data['old_banner_mob'], $photoNameMob, $directoryPath);
//                }
//            }

            $businessInternet = $this->internetRepo->saveInternet($bannerWeb, $bannerMob, $data);
            $this->_saveSearchData($businessInternet);

            return [
                'success' => 1,
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Upload/Save excel file
     * @return JsonResponse
     */
    public function saveExcel($request) {
        return $this->internetRepo->saveExcelFile($request);
    }

    /**
     * change home show
     * @return JsonResponse
     */
    public function homeShow($packageId) {
        return $this->internetRepo->homeShow($packageId);
    }

    /**
     * change showing status
     * @return JsonResponse
     */
    public function statusChange($packageId) {
        try {

            $card = $this->internetRepo->findOne($packageId);
            $status = $card->status == 1 ? 0 : 1;
            $card->status = $status;
            $card->save();
            $this->_saveSearchData($card);
            $response = [
                'success' => 1
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Delete Internet package
     * @return JsonResponse
     */
    public function deletePackage($packageId) {
        return $this->internetRepo->deletePackage($packageId);
    }

    public function syncSearchData()
    {
        $products = $this->internetRepo->findAll();
        foreach ($products as $product){
            if ($product->status) {
                $this->_saveSearchData($product);
            }
        }
        return [
            'success' => 1,
        ];
    }

}
