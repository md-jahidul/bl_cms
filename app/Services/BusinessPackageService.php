<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 13/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessPackageRepository;
use App\Repositories\BusinessFeaturesRepository;
use App\Repositories\BusinessAssignedFeaturesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class BusinessPackageService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $packageRepo
     */
    protected $packageRepo;
    protected $featureRepo;
    protected $asgnFeatureRepo;

    /**
     * BusinessPackageService constructor.
     * @param BusinessPackageRepository $packageRepo
     * @param BusinessFeaturesRepository $featureRepo
     * @param BusinessAssignedFeaturesRepository $asgnFeatureRepo
     */
    public function __construct(BusinessPackageRepository $packageRepo, BusinessFeaturesRepository $featureRepo, BusinessAssignedFeaturesRepository $asgnFeatureRepo) {
        $this->packageRepo = $packageRepo;
        $this->featureRepo = $featureRepo;
        $this->asgnFeatureRepo = $asgnFeatureRepo;
        $this->setActionRepository($packageRepo);
    }

    /**
     * Get business product categories
     * @return Response
     */
    public function getPackages() {
        $response = $this->packageRepo->getPackageList();
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
     * @return Response
     */
    public function savePackage($request) {
        try {

            $request->validate([
                'name' => 'required',
                'short_details' => 'required',
                'banner_photo' => 'required|mimes:jpg,jpeg,png',
            ]);
            
          

            //file upload in storege
            $filePath = "";
            if ($request['banner_photo'] != "") {
                $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');
            }

            //save data in database 
            $packageId = $this->packageRepo->savePackage($filePath, $request);
            $parentType = 1;
            $this->asgnFeatureRepo->assignFeature($packageId, $parentType, $request->feature);



            $response = [
                'success' => 1,
                'message' => "Package Saved",
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
        $response = $this->packageRepo->getPackageById($packageId);
        return $response;
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
     * @return Response
     */
    public function updatePackage($request) {
        try {

            $request->validate([
                'name' => 'required',
                'short_details' => 'required',
            ]);

            //file upload in storege
            $filePath = "";
            if ($request['banner_photo'] != "") {
                $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_banner']) {
                    $this->deleteFile($request['old_banner']);
                }
            }

            //save data in database 
            $this->packageRepo->updatePackage($filePath, $request);
            $this->asgnFeatureRepo->assignFeature($request->package_id, $request->feature);

            $response = [
                'success' => 1,
                'message' => "Package updated"
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
     * delete business package
     * @return Response
     */
    public function deletePackage($packageId) {

        try {

            $package = $this->findOne($packageId);
            $this->deleteFile($package->banner_photo);
            $package->delete();

            $response = [
                'success' => 1,
                'message' => "Package deleted"
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
     * delete business package
     * @return Response
     */
    public function getFeatures() {

      $features = $this->featureRepo->getActiveFeaturesList();
      return $features;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

}
