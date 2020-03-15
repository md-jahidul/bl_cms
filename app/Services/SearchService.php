<?php

/**
 * User: Bulbul Mahmud Nito
 * Date: 11/03/2020
 */

namespace App\Services;

use App\Repositories\SearchSettingRepository;
use App\Repositories\PopularSearchRepository;
use App\Repositories\TagCategoryRepository;
use App\Repositories\SearchDataRepository;
use App\Repositories\ProductRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class SearchService {

    use CrudTrait;

    /**
     * @var $settingRepo
     * @var $popularRepo
     * @var $tagsRepo
     * @var $dataRepo
     */
    protected $settingRepo;
    protected $popularRepo;
    protected $tagsRepo;
    protected $dataRepo;
    protected $productRepo;

    /**
     * SearchService constructor.
     * @param SearchSettingRepository $settingRepo
     * @param PopularSearchRepository $popularRepo
     * @param TagCategoryRepository $tagsRepo
     * @param SearchDataRepository $dataRepo
     * @param ProductRepository $productRepo
     */
    public function __construct(
    SearchSettingRepository $settingRepo, PopularSearchRepository $popularRepo, TagCategoryRepository $tagsRepo, SearchDataRepository $dataRepo, ProductRepository $productRepo
    ) {
        $this->settingRepo = $settingRepo;
        $this->popularRepo = $popularRepo;
        $this->tagsRepo = $tagsRepo;
        $this->dataRepo = $dataRepo;
        $this->productRepo = $productRepo;
    }

    /**
     * Get search setting data
     * @return Response
     */
    public function getSettingData() {
        $response = $this->settingRepo->getSettingData();
        return $response;
    }

    /**
     * Get popular search  data
     * @return Response
     */
    public function getPopularSearch() {
        $response = $this->popularRepo->getPopularData();
        return $response;
    }

    /**
     * Change category name
     * @return Response
     */
    public function updateSearchLimit($request) {
        $settingId = $request->settingId;
        $limit = $request->limit;
        $response = $this->settingRepo->saveLimit($settingId, $limit);
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
     * Get Products
     * @return Response
     */
    public function getProducts($request) {
        $type = $request->type;
        $response = $this->productRepo->getProductsForSearch($type);

        $options = "";
        foreach ($response as $val) {
            $options .= "<option value='$val->id'>$val->name_en</option>";
        }
        return $options;
    }
    
     /**
     * Get Products
     * @return Response
     */
    public function popularSearchById($kwId) {
        $response = $this->popularRepo->getKeywordById($kwId);
        return $response;
    }

    public function saveSearchData($productId, $name, $url, $type, $tag) {
        return $this->dataRepo->saveData($productId, $name, $url, $type, $tag);
    }

    public function savePopularSearch($request) {
        try {

            $request->validate([
                'keyword' => 'required',
                'type' => 'required',
                'product' => 'required',
            ]);



            //save data in database 
            $productId = $request->product;
            $keyword = $request->keyword;
            $type = $request->type;

            $urlArray = array(
                'prepaid-internet' => 'prepaid/internet-offer/' . $productId,
                'prepaid-voice' => 'prepaid/voice-offer/' . $productId,
                'prepaid-bundle' => 'prepaid/bundle-offer/' . $productId,
                'postpaid-internet' => 'postpaid/internet-offer/' . $productId,
            );
            $url = $urlArray[$type];
            $this->popularRepo->saveKeyword($productId, $keyword, $url);

            $response = [
                'success' => 1,
                'message' => "Keywored is saved!"
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
    

    public function updatePopularSearch($request) {
        try {

            $request->validate([
                'keyword_id' => 'required',
                'keyword' => 'required',
            ]);



            //save data in database 
            $keywordId = $request->keyword_id;
            $keyword = $request->keyword;

           
            $this->popularRepo->updateKeyword($keywordId, $keyword);

            $response = [
                'success' => 1,
            ];


            return $response;
        } catch (\Exception $e) {
            $response = [
                'success' => 0,
            ];
            return $response;
        }
    }

    public function deletePopularSearch($kwId) {
        try {
            $this->popularRepo->deleteKeyword($kwId);
            $response = [
                'success' => 1,
                'message' => "Keywored is deleted!"
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
     * Change category home show status
     * @return Response
     */
    public function popularSearchStatusChange($kwId) {
        $response = $this->popularRepo->changeStatus($kwId);
        return $response;
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
