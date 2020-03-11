<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Session;

class SearchController extends Controller {

    private $searchService;

    /**
     * SearchController constructor.
     * @param EasyPaymentCardService $searchService
     */
    public function __construct(SearchService $searchService) {
        $this->searchService = $searchService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function index() {
        $settings = $this->searchService->getSettingData();
        $popular = $this->searchService->getPopularSearch();
        return view('admin.search.index', compact('settings', 'popular'));
    }

    /**
     * Update search setting limit
     * 
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 11/03/2020
     */
     public function saveLimit(Request $request) {
        $limitChange = $this->searchService->updateSearchLimit($request);
        return $limitChange;
    }
    
    /**
     * Popular search form
     * 
     * @param NO
     * @return Factory|View
     * @Bulbul Mahmud Nito || 11/03/2020
     */
     public function popularSearchCreate() {
//        $tags = $this->searchService->getTags();
//        $products = $this->searchService->getProducts();
//        $this->searchService->saveSearchData(8, "50MB-4Days-13TK (with renewal)", "prepaid/internet-offer/8", 'prepaid-internet', "Hot Offer");
        return view('admin.search.create');
    }
    
     /**
     * save Popular search
     * 
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function popularSearchSave(Request $request) {


        $response = $this->searchService->savePopularSearch($request);
        
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Keyword is saved!');
        } else {
            Session::flash('error', 'Keyword saving process failed!');
        }

        return redirect('/popular-search');
    }
    
     /**
     * delete Popular search
     * 
     * @param $kwId
     * @return Redirect
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function deletePopularSearch($kwId){
        $response = $this->searchService->deletePopularSearch($kwId);
        
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Keyword is deleted!');
        } else {
            Session::flash('error', 'Keyword deleting process failed!');
        }

        return redirect('/popular-search');
    }
    
     /**
     * Get product list by type
     * 
     * @param NO
     * @return $response
     * @Bulbul Mahmud Nito || 11/03/2020
     */
    public function getProductList(Request $request){
        $products = $this->searchService->getProducts($request);
        return $products;
    }

  
    

}
