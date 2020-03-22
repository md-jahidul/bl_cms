<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\RoamingCategoryRepository;
use App\Repositories\BusinessHomeBannerRepository;
use App\Repositories\BusinessSlidingRepository;
use App\Repositories\BusinessNewsRepository;
use App\Repositories\BusinessFeaturesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;

class RoamingGeneralService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $businessCatRepo
     * @var $businessBannerRepo
     */
    protected $catRepo;
    protected $businessBannerRepo;
    protected $slidingRepo;
    protected $businessNewsRepo;
    protected $businessFeaturesRepo;

    /**
     * BusinessHomeService constructor.
     * @param RoamingCategoryRepository $catRepo
     * @param BusinessHomeBannerRepository $businessBannerRepo
     * @param BusinessSlidingRepository $slidingRepo
     * @param BusinessNewsRepository $businessNewsRepo
     * @param BusinessFeaturesRepository $businessFeaturesRepo
     */
    public function __construct(
    RoamingCategoryRepository $catRepo,
            BusinessHomeBannerRepository $businessBannerRepo, BusinessSlidingRepository $slidingRepo, BusinessNewsRepository $businessNewsRepo, BusinessFeaturesRepository $businessFeaturesRepo
    ) {
        $this->catRepo = $catRepo;
        $this->businessBannerRepo = $businessBannerRepo;
        $this->slidingRepo = $slidingRepo;
        $this->businessNewsRepo = $businessNewsRepo;
        $this->businessFeaturesRepo = $businessFeaturesRepo;
    }

    /**
     * Get Roaming categories
     * @return Response
     */
    public function getCategories() {
        $response = $this->catRepo->getCategoryList();
        return $response;
    }

    /**
     * Get single category data by Id
     * @return Response
     */
    public function getCategoryById($catId) {
        $response = $this->catRepo->getCategory($catId);
        return $response;
    }
    
    
    
    
     /**
     * update roaming category
     * @return Response
     */
    public function updateCategory($request) {
        try {

            $request->validate([
                'name_en' => 'required',
                'name_bn' => 'required',
            ]);

            //file upload in storege
            $webPath = "";
            if ($request['banner_web'] != "") {
                $webPath = $this->upload($request['banner_web'], 'assetlite/images/roaming');

                //delete old web photo
                if ($request['old_photo']) {
                    $this->deleteFile($request['old_web']);
                }
            }
            $mobilePath = "";
            if ($request['banner_mobile'] != "") {
                $mobilePath = $this->upload($request['banner_mobile'], 'assetlite/images/roaming');

                //delete old mobile photo
                if ($request['old_mobile']) {
                    $this->deleteFile($request['old_mobile']);
                }
            }

            //save data in database 
            $saveNews = $this->catRepo->updateCategory($webPath, $mobilePath, $request);



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
     * Change category sorting
     * @return Response
     */
    public function changeCategorySort($request) {
        $response = $this->catRepo->changeCategorySorting($request);
        return $response;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * Change category name
     * @return Response
     */
    public function changeCategoryName($request) {
        $catId = $request->catId;
        $type = $request->type;
        $name = $request->name;
        $response = $this->businessCatRepo->changeCategoryName($catId, $type, $name);
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
     * save business category banner
     * @return Response
     */
    public function saveCatBanners($request) {
        try {

            $request->validate([
                'banner_photo' => 'required'
            ]);

            //file upload in storege
            $filePath = "";
            if ($request['banner_photo'] != "") {
                $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_photo']) {
                    $this->deleteFile($request['old_photo']);
                }
            }

            //save data in database 
            $newPhoto = $this->businessCatRepo->saveBannerPhoto($filePath, $request['alt_text'], $request['cat_id']);
            
            $photo = $newPhoto == "" ? $request['old_photo'] : $newPhoto;

            $response = [
                'success' => 1,
                'banner_photo' => $photo,
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
     * save business landing page top banner
     * @return Response
     */
    public function saveHomeBanners($request) {
        try {

            $request->validate([
                'home_sort' => 'required'
            ]);

            //file upload in storege
            $filePath = "";
            if ($request['banner_photo'] != "") {
                $filePath = $this->upload($request['banner_photo'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_photo']) {
                    $this->deleteFile($request['old_photo']);
                }
            }

            //save data in database 
            $newPhoto = $this->businessBannerRepo->saveBannerPhoto($filePath, $request['alt_text'], $request['home_sort']);
            
            $photo = $newPhoto == "" ? $request['old_photo'] : $newPhoto;

            $response = [
                'success' => 1,
                'photo' => $photo,
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
     * Change category home show status
     * @return Response
     */
    public function categoryStatusChange($catId) {
        $response = $this->businessCatRepo->changeHomeShowStatus($catId);
        return $response;
    }
    
    

    /**
     * Get business sliding speed
     * @return Response
     */
    public function slidingSpeed() {
        $response = $this->slidingRepo->getSlidingSpeed();
        return $response;
    }
    
     /**
     * save business sliding speed
     * @return Response
     */
    public function saveSlidingSpeed($request) {
        try {

            $request->validate([
                'enSpeed' => 'required',
                'newsSpeed' => 'required'
            ]);

        

            //save data in database 
            $this->slidingRepo->saveSpeed($request['enSpeed'], $request['newsSpeed']);
            

            $response = [
                'success' => 1,
                'message' => "Speed is updated successfully!"
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
                'title_bn' => 'required',
                'body_bn' => 'required'
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
     * Change features sorting
     * @return Response
     */
    public function changeNewsSort($request) {
        $response = $this->businessNewsRepo->changeNewsSorting($request);
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
                'title' => 'required',
                'title_bn' => 'required'
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
