<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\BusinessOthersService;
use App\Services\BusinessPackageService;
use Illuminate\Http\Request;
use Session;

class BusinessOthersController extends Controller {

    private $othersService;
    private $packageService;

    /**
     * BusinessOthersController constructor.
     * @param BusinessOthersService $othersService
     * @param BusinessPackageService $packageService
     */
    public function __construct(BusinessOthersService $othersService, BusinessPackageService $packageService) {
        $this->othersService = $othersService;
        $this->packageService = $packageService;
    }

    /**
     * List of business other services.
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 18/02/2020
     */
    public function index() {
        $businessSolution = $this->othersService->getOtherService('business-solusion');
        $iot = $this->othersService->getOtherService('iot');
        $others = $this->othersService->getOtherService('others');
        return view('admin.business.other_services', compact("businessSolution", "iot", "others"));
    }

    /**
     * create business packages [form].
     * 
     * @param No
     * @return Redirect
     * @Bulbul Mahmud Nito || 18/02/2020
     */
    public function create() {
        $features = $this->packageService->getFeatures();
        return view('admin.business.other_services_create', compact("features"));
    }

    /**
     * create business packages add components [form].
     * 
     * @param $serviceId
     * @return Redirect
     * @Bulbul Mahmud Nito || 18/02/2020
     */
    public function addComponent($serviceId) {
        return view('admin.business.other_services_components', compact("serviceId"));
    }

    /**
     * save business other service/packages.
     * 
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function saveService(Request $request) {
        
        
         $response = $this->othersService->saveService($request);
         
        if($response['success'] == 1){
           Session::flash('sussess', 'Service is saved!');  
        }else{
            Session::flash('error', 'Service saving process failed!'); 
        }
        
        return redirect('/business-other-services');
    }
    
    /**
     * save business other service/packages.
     * 
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function saveComponents(Request $request) {
        
//        print_r($request->all());die();
        
        
         $response = $this->othersService->saveComponents($request);
         
        if($response['success'] == 1){
           Session::flash('sussess', 'Service components is saved!');  
        }else{
            Session::flash('error', 'Service components saving process failed!'); 
        }
        
//        return redirect('/business-other-services');
    }
    
    
    
    
     
    /**
     * home show status of business packages .
     * 
     * @param $serviceId
     * @return Response
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function homeShow($serviceId) {
        
        $response = $this->othersService->homeStatusChange($serviceId);
        return $response;
    }
    
    /**
     * home show status of business active/inactive .
     * 
     * @param $serviceId
     * @return Response
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function activationStatus($serviceId) {
        
        $response = $this->othersService->packageActive($serviceId);
        return $response;
    } 
    
    
    
        /**
     * Service Sorting Change.
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 19/02/2020
     */
    public function sortChange(Request $request) {
        $sortChange = $this->othersService->changeServiceSort($request);
        return $sortChange;
    }
    
    
  
    
     /**
     * edit business other service [form].
     * 
     * @param $serviceId
     * @return Redirect
     * @Bulbul Mahmud Nito || 20/02/2020
     */
    public function edit($serviceId) {
        $service = $this->othersService->getServiceById($serviceId);
        $serviceType = $service->type;
        
        $features = $this->packageService->getFeatures();
        $asgnFeatures = $this->othersService->getFeaturesByService($serviceType, $serviceId);
        return view('admin.business.other_services_edit', compact('service', 'features', 'asgnFeatures'));
    }
    
    
    /**
     * update business other service.
     * 
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 20/02/2020
     */
    public function update(Request $request) {
        
         $response = $this->othersService->updateService($request);
        
        if($response['success'] == 1){
           Session::flash('sussess', 'Service is updated!');  
        }else{
            Session::flash('error', 'Service updating process failed!'); 
        }
        
        return redirect('/business-other-services');
    }
    
    
    /**
     * delete business service .
     * 
     * @param $serviceId
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function deleteService($serviceId) {
        
         $response = $this->othersService->deleteService($serviceId);
        
        if($response['success'] == 1){
           Session::flash('sussess', 'Service is deleted!');  
        }else{
            Session::flash('error', 'Service deleting process failed!'); 
        }
        
        return redirect('/business-other-services');
    }
    
   
    
    


}
