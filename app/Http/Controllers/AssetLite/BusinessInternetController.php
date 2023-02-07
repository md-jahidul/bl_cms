<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessInternetPackageRequest;
use App\Services\BusinessInternetService;
use Illuminate\Http\Request;
use Session;

class BusinessInternetController extends Controller {

    private $internetService;

    /**
     * BusinessInternetController constructor.
     * @param BusinessInternetService $internetService
     */
    public function __construct(BusinessInternetService $internetService) {
        $this->internetService = $internetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param NA
     * @return Factory|View
     * @Bulbul Mahmud Nito || 17/02/2020
     */
    public function index() {
        return view('admin.business.internet_packages');
    }

    /**
     * Internet Create Form
     *
     * @param NA
     * @return Factory|View
     * @Bulbul Mahmud Nito || 12/03/2020
     */
    public function internetCreate() {
        $otherPorducts = $this->internetService->getAllPackage();
        $tags = $this->internetService->getTags();
        return view('admin.business.internet_package_create', compact('otherPorducts', 'tags'));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveInternetPackage(BusinessInternetPackageRequest $request) {

        $response = $this->internetService->saveInternet($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Package is saved!');
        } else {
            Session::flash('error', 'Package saving process failed!');
        }

        return redirect('/business-internet');
    }


    /**
     * Internet edit Form
     *
     * @param NA
     * @return Factory|View
     * @Bulbul Mahmud Nito || 12/03/2020
     */
    public function internetEdit($internetId) {
        $internet = $this->internetService->getInternetById($internetId);
        $otherPorducts = $this->internetService->getAllPackage($internetId);
        $tags = $this->internetService->getTags();
        return view('admin.business.internet_package_edit', compact('internet', 'otherPorducts', 'tags'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateInternetPackage(BusinessInternetPackageRequest $request) {

        $response = $this->internetService->updateInternet($request);

//        dd($response);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Package is updated!');
        } else {
            Session::flash('error', 'Package updating process failed!');
        }

        return redirect('/business-internet');
    }


    public function internetPackageList(Request $request) {

        $response = $this->internetService->getInternetPackage($request);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadInternetExcel(Request $request) {

        $response = $this->internetService->saveExcel($request);
        return $response;
    }

    public function packageHomeShow($packageId) {
        $response = $this->internetService->homeShow($packageId);
        return $response;
    }

    public function packageStatusChange($packageId) {
        $response = $this->internetService->statusChange($packageId);
        return $response;
    }

    public function deletePackage($packageId = 0) {

        $response = $this->internetService->deletePackage($packageId);
        return $response;
    }

}
