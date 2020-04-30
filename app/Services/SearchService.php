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
            
            $product = $this->productRepo->findOrFail($productId);
            
            $categoryUrl = $product->offer_category->url_slug;

            $urlArray = array(
                'prepaid-internet' => "prepaid/$categoryUrl/$product->url_slug/$productId",
                'prepaid-voice' => "prepaid/$categoryUrl/$product->url_slug/$productId",
                'prepaid-bundle' => "prepaid/$categoryUrl/$product->url_slug/$productId",
                'postpaid-internet' => "postpaid/$categoryUrl/$product->url_slug/$productId",
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
    
     /**
     * Change features sorting
     * @return Response
     */
    public function changeKeywordSort($request) {
        $response = $this->popularRepo->changeKeywordSorting($request);
        return $response;
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

}
