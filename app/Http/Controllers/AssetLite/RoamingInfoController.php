<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\RoamingInfoService;
use Illuminate\Http\Request;
use Session;

class RoamingInfoController extends Controller {

    private $infoService;

    /**
     * RoamingInfoController constructor.
     * @param RoamingInfoService $infoService
     */
    public function __construct(RoamingInfoService $infoService) {
        $this->infoService = $infoService;
    }
    
    /**
     * Display Categories, and info/tips list
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function index() {
        $categories = $this->infoService->getCategories();
        $info = $this->infoService->getInfoList();

        return view('admin.roaming.info_tips', compact('categories', 'info'));
    }
    
        /**
     * Get category by ID
     * 
     * @param cat ID $catId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito ||  27/03/2020
     */
    public function getSingleCategory($catId) {

        $response = $this->infoService->getCategoryById($catId);
        return $response;
    }

    /**
     * Update category
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito ||  27/03/2020
     */
    public function saveCategory(Request $request) {

        $response = $this->infoService->updateCategory($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Category is saved!');
        } else {
            Session::flash('error', 'Category saving process failed!');
        }

        return redirect('/roaming-info-tips');
    }
    
     /**
     * Category Sorting Change.
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function categorySortChange(Request $request) {
        $sortChange = $this->infoService->changeCategorySort($request);
        return $sortChange;
    }
    
    /**
     * Add Info & Tips Form
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function createInfo() {

        $categories = $this->infoService->getCategories();

        return view('admin.roaming.create_info_tips', compact('categories'));
    }
    
      /**
     * edit info and tips form
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function editInfo($infoId) {
        $categories = $this->infoService->getCategories();
        $info = $this->infoService->getInfoById($infoId);
        return view('admin.roaming.edit_info', compact('categories', 'info'));
    }
    
    
    /**
     * Save info & tips
     * 
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function saveInfo(Request $request) {
//        print_r($request->all());die();

        if ($request->info_id == "") {
            $response = $this->infoService->saveInfo($request);
        } else {
            $response = $this->infoService->updateInfo($request);
        }

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is saved!');
        } else {
            Session::flash('error', 'Offer saving process failed!');
        }

        return redirect('roaming-info-tips');
    }
    
       /**
     * Delete info & tips
     * 
     * @param $infoId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function deleteInfo($infoId) {
        $response = $this->infoService->deleteInfo($infoId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Info/Tips is deleted!');
        } else {
            Session::flash('error', 'Info/Tips deleting process failed!');
        }

        return redirect('roaming-info-tips');
    }
    
      
      /**
     * edit components
     * 
     * @param $infoId
     * @return Factory|View
     * @Bulbul Mahmud Nito || 27/03/2020
     */
    public function editComponent($infoId) {
        $components = $this->infoService->getInfoComponents($infoId);
        return view('admin.roaming.info_components', compact('components', 'infoId'));
    }
    
    
     /*###################################### DONE  #################################################*/

    



   

    

  
  

    

 
    
  
    
      /**
     * Update other offer components
     * 
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 26/03/2020
     */
    public function updateComponent(Request $request) {
//        print_r($request->all());die();

            $response = $this->offerService->updateComponents($request);
      
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is saved!');
        } else {
            Session::flash('error', 'Offer saving process failed!');
        }

        return redirect('roaming/edit-other-offer-component/'.$request->parent_id);
    }
    
     /**
     * Component Sorting Change.
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 26/03/2020
     */
    public function componentSortChange(Request $request) {
        $sortChange = $this->offerService->changeComponentSort($request);
        return $sortChange;
    }

}
