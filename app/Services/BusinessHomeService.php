<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/02/2020
 */

namespace App\Services;

use App\Repositories\BusinessCategoryRepository;
use App\Repositories\BusinessHomeBannerRepository;
use App\Repositories\BusinessSlidingRepository;
use App\Repositories\BusinessNewsRepository;
use App\Repositories\BusinessFeaturesRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BusinessHomeService {

    use CrudTrait;
    use FileTrait;

    /**
     * @var $businessCatRepo
     * @var $businessBannerRepo
     */
    protected $businessCatRepo;
    protected $businessBannerRepo;
    protected $slidingRepo;
    protected $businessNewsRepo;
    protected $businessFeaturesRepo;

    /**
     * BusinessHomeService constructor.
     * @param BusinessCategoryRepository $businessCatRepo
     * @param BusinessHomeBannerRepository $businessBannerRepo
     * @param BusinessSlidingRepository $slidingRepo
     * @param BusinessNewsRepository $businessNewsRepo
     * @param BusinessFeaturesRepository $businessFeaturesRepo
     */
    public function __construct(
        BusinessCategoryRepository $businessCatRepo,
        BusinessHomeBannerRepository $businessBannerRepo,
        BusinessSlidingRepository $slidingRepo,
        BusinessNewsRepository $businessNewsRepo,
        BusinessFeaturesRepository $businessFeaturesRepo
    ) {
        $this->businessCatRepo = $businessCatRepo;
        $this->businessBannerRepo = $businessBannerRepo;
        $this->slidingRepo = $slidingRepo;
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
     * Get business product category by id
     * @return Response
     */
    public function getCategoryById($catId) {
        $response = $this->businessCatRepo->getCategoryById($catId);
        return $response;
    }

    /**
     * Change category name
     * @return array
     */
    public function updateCategory($request)
    {
        try {
            $status = true;
            $update = [];

            $catId = $request->cat_id;

        $update['name'] = $request->name_en;
        $update['name_bn'] = $request->name_bn;
        $update['alt_text'] = $request->alt_text;
        $update['banner_name'] = $request->banner_name;
        $update['url_slug'] = $request->url_slug;
        $update['url_slug_bn'] = $request->url_slug_bn;
        $update['schema_markup'] = $request->schema_markup;
        $update['page_header'] = $request->page_header;
        $update['page_header_bn'] = $request->page_header_bn;
        $update['updated_by'] = Auth::id();

            $update['banner_title_en'] = $request->banner_title_en;
            $update['banner_title_bn'] = $request->banner_title_bn;
            $update['banner_desc_en'] = $request->banner_desc_en;
            $update['banner_desc_bn'] = $request->banner_desc_bn;
//            $update['alt_text'] = $request->alt_text;
//            $update['alt_text_bn'] = $request->alt_text_bn;
            $update['banner_name'] = $request->banner_name;
            $update['banner_name_bn'] = $request->banner_name_bn;
            $update['url_slug'] = $request->url_slug;
            $update['url_slug_bn'] = $request->url_slug_bn;
            $update['schema_markup'] = $request->schema_markup;
            $update['page_header'] = $request->page_header;
            $update['page_header_bn'] = $request->page_header_bn;
            $update['updated_by'] = Auth::id();
            if (!empty($request['banner_web'])) {
                //delete old web photo
                if ($request['old_web_img'] != "") {
                    $this->deleteFile($request['old_web_img']);
                }
                $photoName = pathinfo($request->file('banner_web')->getClientOriginalName(), PATHINFO_FILENAME).time(). '-web';
                $update['banner_photo'] = $this->upload($request['banner_web'], 'assetlite/images/business-images', $photoName);
                $status = $update['banner_photo'];
            }

            if (!empty($request['banner_mobile'])) {
                //delete old web photo
                if ($request['old_mob_img'] != "") {
                    $this->deleteFile($request['old_mob_img']);
                }

                $photoName = pathinfo($request->file('banner_mobile')->getClientOriginalName(), PATHINFO_FILENAME).time() . '-mobile';
                $update['banner_image_mobile'] = $this->upload($request['banner_mobile'], 'assetlite/images/business-images', $photoName);
                $status = $update['banner_image_mobile'];
            }


            if ($status) {
                $this->businessCatRepo->updateCategory($update, $catId);
                $response = [
                    'success' => 1,
                ];
            } else {
                $response = [
                    'success' => 2,
                ];
            }

            return $response;
        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
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

            $filePathMob = "";
            if ($request['banner_photo_mobile'] != "") {
                $filePathMob = $this->upload($request['banner_photo_mobile'], 'assetlite/images/business-images');

                //delete old photo
                if ($request['old_photo_mobile']) {
                    $this->deleteFile($request['old_photo_mobile']);
                }
            }

            //save data in database
            $newPhoto = $this->businessBannerRepo->saveBannerPhoto($filePath, $filePathMob, $request['alt_text'], $request['home_sort']);

            $photo = $newPhoto == "" ? $request['old_photo'] : $newPhoto;
            $photoMob = $filePathMob == "" ? $request['old_photo_mobile'] : $filePathMob;

            $response = [
                'success' => 1,
                'photo' => $photo,
                'photo_mob' => $photoMob,
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
