<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPackageRequest;
use App\Services\BusinessPackageService;
use Illuminate\Http\Request;
use Session;

class BusinessPackageController extends Controller {

    private $packageService;

    /**
     * BusinessPackageController constructor.
     * @param BusinessPackageService $packageService
     */
    public function __construct(BusinessPackageService $packageService) {
        $this->packageService = $packageService;
    }

    /**
     * List of business packages.
     *
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function index() {
        $packages = $this->packageService->getPackages();
        return view('admin.business.package_list', compact('packages'));
    }

    /**
     * create business packages [form].
     *
     * @param No
     * @return Redirect
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function create() {
        $features = $this->packageService->getFeatures();
        $packages = $this->packageService->getPackages();
        return view('admin.business.package_create', compact("features", "packages"));
    }

    /**
     * save business packages .
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function store(BusinessPackageRequest $request) {
        $response = $this->packageService->savePackage($request);

        if($response['success'] == 1){
            Session::flash('sussess', 'Package is saved!');
        }else{
            Session::flash('error', 'Package saving process failed!');
        }

        return redirect('/business-package');
    }

    /**
     * Package Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 16/02/2020
     */
    public function sortChange(Request $request) {
        $sortChange = $this->packageService->changePackageSort($request);
        return $sortChange;
    }


    /**
     * home show status of business packages .
     *
     * @param $packageId
     * @return Response
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function homeShow($packageId) {

        $response = $this->packageService->homeStatusChange($packageId);
        return $response;
    }

    /**
     * home show status of business active/inactive .
     *
     * @param $packageId
     * @return Response
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function activationStatus($packageId) {

        $response = $this->packageService->packageActive($packageId);
        return $response;
    }

    /**
     * edit business packages [form].
     *
     * @param $packageId
     * @return Redirect
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function edit($packageId) {
        $package = $this->packageService->getPackageById($packageId);
        $features = $this->packageService->getFeatures();
        $asgnFeatures = $this->packageService->getFeaturesByPackage($packageId);
        $packages = $this->packageService->getPackages($packageId);
        $relatedProducts = $this->packageService->relatedProducts($packageId);
        return view('admin.business.package_edit', compact('package', 'features', 'asgnFeatures', "packages", "relatedProducts"));
    }


    /**
     * update business packages .
     *
     * @param Request $request
     * @return Redirect
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function update(BusinessPackageRequest $request) {
        //dd($request->all());
        $response = $this->packageService->updatePackage($request);

        if($response['success'] == 1){
            Session::flash('sussess', 'Package is updated!');
        }else{
            Session::flash('error', 'Package updating process failed!');
        }

        return redirect('/business-package');
    }


    /**
     * delete business packages .
     *
     * @param $packageId
     * @return Redirect
     * @Bulbul Mahmud Nito || 16/02/2020
     */
    public function delete($packageId) {

        $response = $this->packageService->deletePackage($packageId);

        if($response['success'] == 1){
            Session::flash('sussess', 'Package is deleted!');
        }else{
            Session::flash('error', 'Package deleting process failed!');
        }

        return redirect('/business-package');
    }






}
