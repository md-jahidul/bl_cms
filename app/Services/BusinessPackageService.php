<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessPackageRepository;
use App\Repositories\BusinessFeaturesRepository;
use App\Repositories\BusinessAssignedFeaturesRepository;
use App\Repositories\BusinessRelatedProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class BusinessPackageService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $packageRepo
     * @var $featureRepo
     * @var $asgnFeatureRepo
     * @var $relatedProductRepo
     */
    protected $packageRepo;
    protected $featureRepo;
    protected $asgnFeatureRepo;
    protected $relatedProductRepo;

    /**
     * BusinessPackageService constructor.
     * @param BusinessPackageRepository $packageRepo
     * @param BusinessFeaturesRepository $featureRepo
     * @param BusinessAssignedFeaturesRepository $asgnFeatureRepo
     * @param BusinessRelatedProductRepository $relatedProductRepo
     */
    public function __construct(BusinessPackageRepository $packageRepo, BusinessFeaturesRepository $featureRepo, BusinessAssignedFeaturesRepository $asgnFeatureRepo, BusinessRelatedProductRepository $relatedProductRepo) {
        $this->packageRepo = $packageRepo;
        $this->featureRepo = $featureRepo;
        $this->asgnFeatureRepo = $asgnFeatureRepo;
        $this->relatedProductRepo = $relatedProductRepo;
        $this->setActionRepository($packageRepo);
    }

    /**
     * Get business product categories
     * @return Response
     */
    public function getPackages($packageId = 0) {
        $response = $this->packageRepo->getPackageList($packageId);
        return $response;
    }

    /**
     * Change package sorting
     * @return Response
     */
    public function changePackageSort($request) {
        $response = $this->packageRepo->changePackageSorting($request);
        return $response;
    }

    /**
     * save business landing page news
     * @return array
     */
    public function savePackage($request) {
        try {
            //file upload in storege
            $directoryPath = 'assetlite/images/business-images';

            $cardWeb = "";
            $cardMob = "";

            if (!empty($request['card_banner_web'])) {
                $photoName = $request['card_banner_web'] . '-web';
                $cardWeb = $this->upload($request['card_banner_web'], $directoryPath, $photoName);
            }
            if (!empty($request['card_banner_mobile'])) {

                $photoName = $request['card_banner_mobile'] . '-mobile';
                $cardMob = $this->upload($request['card_banner_mobile'], $directoryPath, $photoName);
            }


            $bannerWeb = "";
            $bannerMob = "";
            if (!empty($request['banner_photo'])) {
                $photoName = $request['banner_name'] . '-web';
                $bannerWeb = $this->upload($request['banner_photo'], $directoryPath, $photoName);
            }
            if (!empty($request['banner_mobile'])) {

                $photoName = $request['banner_name'] . '-mobile';
                $bannerMob = $this->upload($request['banner_mobile'], $directoryPath, $photoName);
            }
            $cardIcon = null;
            if (!empty($request['icon'])) {
                $cardIcon = $this->upload($request['icon'], $directoryPath);
            }

            $cardDetail = null;
            if (!empty($request['detail_image'])) {
                $cardDetail = $this->upload($request['detail_image'], $directoryPath);
            }
            //save data in database
            $package = $this->packageRepo->savePackage($cardWeb, $cardMob, $bannerWeb, $bannerMob, $cardIcon, $cardDetail, $request);

            $this->_saveSearchData($package);

            $parentType = 1;
            $this->asgnFeatureRepo->assignFeature($package->id, $parentType, $request->feature);
            $this->relatedProductRepo->assignRelatedProduct($package->id, $parentType, $request->realated);

            return [
                'success' => 1,
                'message' => "Package Saved",
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
        // URL make
        $urlEn = "business/" . "packages" . '/' . $product->url_slug;
        $urlBn = "business/" . "packages" . '/' . $product->url_slug_bn;

        $saveSearchData = [
            'product_code' => null,
            'type' => 'business-packages',
            'page_title_en' => $product->name,
            'page_title_bn' => $product->name_bn,
            'url_slug_en' => $urlEn,
            'url_slug_bn' => $urlBn,
            'status' => 1,
        ];

        if ($product->searchableFeature()->first()) {
            $product->searchableFeature()->update($saveSearchData);
        } else {
            $product->searchableFeature()->create($saveSearchData);
        }
    }

    /**
     * get related product
     * @return Response
     */
    public function relatedProducts($packageId) {
        $parentType = 1;
        $response = $this->relatedProductRepo->getRelatedProductList($packageId, $parentType);
        return $response;
    }

    /**
     * Change package home show status
     * @return Response
     */
    public function homeStatusChange($packageId) {
        $response = $this->packageRepo->changeHomeShowStatus($packageId);
        return $response;
    }

    /**
     * Change package active/inactive
     * @return Response
     */
    public function packageActive($packageId) {
        $response = $this->packageRepo->changeStatus($packageId);
        return $response;
    }

    /**
     * Get business package by id
     * @return Response
     */
    public function getPackageById($packageId) {
        return $this->packageRepo->getPackageById($packageId);
    }


    /**
     * Get business package by id
     * @return Response
     */
    public function getFeaturesByPackage($packageId) {
        $parentType = 1; //parent type 1 for package
        $response = $this->asgnFeatureRepo->getAssignedFeatures($packageId, $parentType);
        return $response;
    }

    /**
     * update business landing page news
     * @return array
     */
    public function updatePackage($data) {
        try {

            $directoryPath = 'assetlite/images/business-images';

            $cardWeb = "";
            $cardMob = "";
            $cardIcon = "";
            $cardDetail = "";
            if (!empty($data['card_banner_web'])) {

                $data['old_card_banner_web'] != "" ? $this->deleteFile($data['old_card_banner_web']) : "";
                $cardWeb = $this->upload($data['card_banner_web'], $directoryPath);
            }

            if (!empty($data['card_banner_mobile'])) {

                $data['old_card_banner_mobile'] != "" ? $this->deleteFile($data['old_card_banner_mobile']) : "";
                $cardMob = $this->upload($data['card_banner_mobile'], $directoryPath);
            }

            if (!empty($data['icon'])) {

                $data['old_icon'] != "" ? $this->deleteFile($data['old_icon']) : "";
                $cardIcon = $this->upload($data['icon'], $directoryPath);
            }

            if (!empty($data['detail_image'])) {

                $data['old_detail_image'] != "" ? $this->deleteFile($data['old_detail_image']) : "";
                $cardDetail = $this->upload($data['detail_image'], $directoryPath);
            }

            $photoNameWeb = $data['banner_name'] . '-web';
            $photoNameMob = $data['banner_name'] . '-mobile';
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
            //save data in database
            $package = $this->packageRepo->updatePackage($cardWeb, $cardMob, $bannerWeb, $bannerMob, $cardIcon, $cardDetail, $data);

            $this->_saveSearchData($package);

            $parentType = 1;
            $this->asgnFeatureRepo->assignFeature($data->package_id, $parentType, $data->feature);

            $this->relatedProductRepo->assignRelatedProduct($data->package_id, $parentType, $data->realated);

            return [
                'success' => 1,
                'message' => "Package updated"
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * delete business package
     * @return array
     */
    public function deletePackage($packageId) {
        try {
            $package = $this->findOne($packageId);
            $this->deleteFile($package->banner_photo);
            $package->delete();
            $package->searchableFeature()->delete();
            return [
                'success' => 1,
                'message' => "Package deleted"
            ];
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * delete business package
     * @return Response
     */
    public function getFeatures() {

        $features = $this->featureRepo->getActiveFeaturesList();
        return $features;
    }

}
