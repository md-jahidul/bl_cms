<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessOtherPackageRequest;
use App\Services\BusinessOthersService;
use App\Services\BusinessPackageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
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
     * @return Application|Factory|View
     * @Bulbul Mahmud Nito || 18/02/2020
     */
    public function index() {
        $businessSolution = $this->othersService->getOtherService('business-solution');
//        $iot = $this->othersService->getOtherService('iot');
//        $others = $this->othersService->getOtherService('others');
//        $corona = $this->othersService->getOtherService('');
        return view('admin.business.other_services', compact("businessSolution"));
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
        $services = $this->othersService->getOtherService();
        return view('admin.business.other_services_create', compact("features", "services"));
    }

    /**
     * save business other service/packages.
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function saveService(BusinessOtherPackageRequest $request) {

        $response = $this->othersService->saveService($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Service is saved!');
        } else {
            Session::flash('error', 'Service saving process failed!');
        }

        return redirect('/business-other-services')->withInput();
    }


     /**
     * List of business other services component list by serviceID.
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 20/02/2020
     */
    public function componentList($serviceId, $type = '') {
        $service = $this->othersService->getServiceById($serviceId, $type);
        $serviceName = $service->name;
        $serviceId = $service->id;
        $components = $this->othersService->getComponents($serviceId);
        return view('admin.business.service_component_list', compact("components", "serviceId", "serviceName"));
    }


    /**
     * create business packages add components [form].
     *
     * @param $serviceId
     * @return Redirect
     * @Bulbul Mahmud Nito || 18/02/2020
     */
    public function addComponent($serviceId) {
        $service = $this->othersService->getServiceById($serviceId);
        $serviceName = $service->name;
        return view('admin.business.services_components_add', compact("serviceId", "serviceName"));
    }

    /**
     * save business other service/packages component.
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function saveComponents(Request $request) {

//        print_r($request->all());die();


        $components = $this->othersService->getComponents($request->service_id);
        $oldComponents = count($components);
        $response = $this->othersService->saveComponents($request, $oldComponents);

//        dd($response);die();

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Service components is saved!');
        } else {
            Session::flash('error', 'Service components saving process failed!');
        }

        return redirect('/business-others-components-list/' . $request->service_id);
    }

    /**
     * delete business service component.
     *
     * @param $serviceId, $position
     * @return Redirect
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function deleteComponent($serviceId, $position, $type) {

        $response = $this->othersService->deleteComponent($serviceId, $position, $type);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Component is deleted!');
        } else {
            Session::flash('error', 'Component deleting process failed!');
        }

        return redirect('business-others-components-list/' . $serviceId);
    }

    /**
     * Service component Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 20/02/2020
     */
    public function sortComponent(Request $request) {
        $sortChange = $this->othersService->changeComponentSort($request);
        return $sortChange;
    }

    /**
     * Service component edit.
     *
     * @param $serviceId, $position, $type
     * @return Factory|View
     * @Dev Bulbul Mahmud Nito || 26/02/2020
     */
    public function editComponent($serviceId, $position, $type) {
        $component = $this->othersService->getSingleComponent($serviceId, $position, $type);
         $service = $this->othersService->getServiceById($serviceId);
        $serviceName = $service->name;

//        print_r($component);die();
        return view('admin.business.services_components_edit', compact("component", "type", "serviceId", "serviceName"));
    }

      /**
     * update business other service/packages component.
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 27/02/2020
     */
    public function updateComponents(Request $request) {

//        print_r($request->all());die();


        $response = $this->othersService->updateComponents($request);

//        dd($response);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Service component is updated!');
        } else {
            Session::flash('error', 'Service component updating process failed!');
        }

        return redirect('/business-others-components-list/' . $request->service_id);
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
     * home show status of business packages .
     *
     * @param $serviceId
     * @return Response
     * @Bulbul Mahmud Nito || 19/02/2020
     */
    public function homeSlider($serviceId) {

        $response = $this->othersService->homeSlider($serviceId);
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

        return $this->othersService->packageActive($serviceId);
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
    public function edit($serviceId, $type = '') {
        $service = $this->othersService->getServiceById($serviceId, $type);
        $serviceType = $service->type;

        $features = $this->packageService->getFeatures();
        $asgnFeatures = $this->othersService->getFeaturesByService($serviceType, $serviceId);

        $services = $this->othersService->getOtherService("", $serviceId);

        $relatedProducts = $this->othersService->relatedProducts($serviceId);
        return view('admin.business.other_services_edit', compact('service', 'features', 'asgnFeatures', 'services', 'relatedProducts', 'serviceId', 'type'));
    }

    /**
     * update business other service.
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 20/02/2020
     */
    public function update(BusinessOtherPackageRequest $request) {
        $response = $this->othersService->updateService($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Service is updated!');
        } else {
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

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Service is deleted!');
        } else {
            Session::flash('error', 'Service deleting process failed!');
        }

        return redirect('/business-other-services');
    }

}
