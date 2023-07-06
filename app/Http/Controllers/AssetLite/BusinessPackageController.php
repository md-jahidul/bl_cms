<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessPackageRequest;
use App\Services\Assetlite\ComponentService;
use App\Services\BusinessPackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;


class BusinessPackageController extends Controller {

    public const PAGE_TYPE = "business_package";

    private $packageService;
    protected $componentService;

    /**
     * BusinessPackageController constructor.
     * @param BusinessPackageService $packageService
     */
    public function __construct(BusinessPackageService $packageService, ComponentService $componentService) {
        $this->packageService = $packageService;
        $this->componentService = $componentService;
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
        $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
        $components = $this->componentService->findBy(['page_type' => self::PAGE_TYPE, 'section_details_id' => 0], '', $orderBy);

        return view('admin.business.package_list', compact('packages','components'));
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
//dd($request->all());
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

    /**
     * Component
     */

    public function componentCreate()
    {
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $storeAction = 'business-package-component.store';
        $listAction = 'business-package-component.list';
        $pageType = self::PAGE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction','listAction', 'pageType'));
    }

    public function componentStore(Request $request)
    {
        // return $request->all();
        $section_details_id = 0;
        $response = $this->componentService->componentStore($request->all(), $section_details_id , self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('/business-package');
    }





    public function componentEdit(Request $request, $id)
    {
        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $updateAction = 'business-package-component.update';
        $listAction = 'business-package-component.list';
        return view('admin.components.edit', compact('component', 'componentList', 'updateAction', 'listAction'));
    }

    public function componentUpdate(Request $request, $id)
    {
        // return $request->all();
        $request['page_type'] = self::PAGE_TYPE;
        $section_details_id = 0;
        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/business-package');
    }


    public function componentSortable(Request $request): Response
    {
        return $this->componentService->tableSortable($request->all());
    }

    public function componentDestroy($id)
    {
        $this->componentService->deleteComponent($id);
        return url()->previous();
    }

}
