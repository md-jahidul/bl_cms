<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessCategoryRepository;
use App\Repositories\BusinessHomeBannerRepository;
use App\Repositories\BusinessNewsRepository;
use App\Repositories\BusinessFeaturesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class BusinessHomeService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $businessCatRepo
     * @var $businessBannerRepo
     */
    protected $businessCatRepo;
    protected $businessBannerRepo;
    protected $businessNewsRepo;
    protected $businessFeaturesRepo;

    /**
     * BusinessHomeService constructor.
     * @param BusinessCategoryRepository $businessCatRepo
     * @param BusinessHomeBannerRepository $businessBannerRepo
     * @param BusinessNewsRepository $businessNewsRepo
     * @param BusinessFeaturesRepository $businessFeaturesRepo
     */
    public function __construct(
    BusinessCategoryRepository $businessCatRepo, BusinessHomeBannerRepository $businessBannerRepo, BusinessNewsRepository $businessNewsRepo, BusinessFeaturesRepository $businessFeaturesRepo
    ) {
        $this->businessCatRepo = $businessCatRepo;
        $this->businessBannerRepo = $businessBannerRepo;
        $this->businessNewsRepo = $businessNewsRepo;
        $this->businessFeaturesRepo = $businessFeaturesRepo;
    }

    /**
     * Get business product categories
     * @return Response
     */
    public function getCategories() {
        $response = $this->businessCatRepo->getCategoryList();
        return $response;
    }

    /**
     * Change category name
     * @return Response
     */
    public function changeCategoryName($request) {
        $catId = $request->catId;
        $name = $request->name;
        $response = $this->businessCatRepo->changeCategoryName($catId, $name);
        return $response;
    }

    /**
     * Get business landing page top banner
     * @return Response
     */
    public function getHomeBanners() {
        $response = $this->businessBannerRepo->getHomeBanners();
        return $response;
    }

    /**
     * save business landing page top banner
     * @return Response
     */
    public function saveHomeBanners($request) {
        try {

            $request->validate([
                'banner_photo' => 'required|mimes:jpg,jpeg,png',
                'home_sort' => 'required'
            ]);

            //file upload in storege
            $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

            //save data in database 
            $newPhoto = $this->businessBannerRepo->saveBannerPhoto($filePath, $request['home_sort']);

            //delete old photo
            if ($request['old_photo']) {
                $this->deleteFile($request['old_photo']);
            }

            $response = [
                'success' => 1,
                'photo' => $newPhoto,
                'sort' => $request['home_sort'],
                'message' => "Banner photo is uploaded successfully!"
            ];


            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Change category sorting
     * @return Response
     */
    public function changeCategorySort($request) {
        $response = $this->businessCatRepo->changeCategorySorting($request);
        return $response;
    }

    /**
     * Change category home show status
     * @return Response
     */
    public function categoryStatusChange($catId) {
        $response = $this->businessCatRepo->changeHomeShowStatus($catId);
        return $response;
    }

    /**
     * Get business news
     * @return Response
     */
    public function getNews() {
        $response = $this->businessNewsRepo->getNews();
        return $response;
    }

    /**
     * save business landing page news
     * @return Response
     */
    public function saveNews($request) {
        try {

            $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);

            //file upload in storege
            $filePath = "";
            if ($request['news_photo'] != "") {
                $filePath = $this->upload($request['news_photo'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_photo']) {
                    $this->deleteFile($request['old_photo']);
                }
            }

            //save data in database 
            $saveNews = $this->businessNewsRepo->saveNews($filePath, $request);



            $response = [
                'success' => 1,
                'message' => "News Saved"
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
     * Get business news by id
     * @return Response
     */
    public function getNewsById($newsId) {
        $response = $this->businessNewsRepo->getSingleNews($newsId);
        return $response;
    }

    /**
     * Change news status
     * @return Response
     */
    public function newsStatusChange($newsId) {
        $response = $this->businessNewsRepo->changeNewsStatus($newsId);
        return $response;
    }

    /**
     * News delete
     * @return Response
     */
    public function deleteNews($newsId) {
        $response = $this->businessNewsRepo->deleteNews($newsId);
        if ($response['photo'] != "") {
            $this->deleteFile($response['photo']);
        }
        return $response;
    }
    
    
      /**
     * Get business features
     * @return Response
     */
    public function getFeatures() {
        $response = $this->businessFeaturesRepo->getFeaturesList();
        return $response;
    }
    
    
     /**
     * Change features sorting
     * @return Response
     */
    public function changeFeatureSort($request) {
        $response = $this->businessFeaturesRepo->changeFeatureSorting($request);
        return $response;
    }
    
    /**
     * Change feature status
     * @return Response
     */
    public function featureStatusChange($request) {
        $response = $this->businessFeaturesRepo->changeFeatureStatus($request);
        return $response;
    }
    
     /**
     * save business feature
     * @return Response
     */
    public function saveFeature($request) {
        try {

            $request->validate([
                'title' => 'required'
            ]);

            //file upload in storege
            $filePath = "";
            if ($request['feature_icon'] != "") {
                $filePath = $this->upload($request['feature_icon'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_photo']) {
                    $this->deleteFile($request['old_photo']);
                }
            }

            //save data in database 
            $this->businessFeaturesRepo->saveFeature($filePath, $request);



            $response = [
                'success' => 1,
                'message' => "Feature Saved"
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
     * Get business feature by id
     * @return Response
     */
    public function getFeaturesById($featureId) {
        $response = $this->businessFeaturesRepo->getSingleFeature($featureId);
        return $response;
    }
    
    
    
    /**
     * Feature delete
     * @return Response
     */
    public function deleteFeature($featureId) {
        $response = $this->businessFeaturesRepo->deleteFeature($featureId);
        if ($response['photo'] != "") {
            $this->deleteFile($response['photo']);
        }
        return $response;
    }

}
