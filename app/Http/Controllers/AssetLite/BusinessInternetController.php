<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\BusinessInternetService;
use Illuminate\Http\Request;

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

    public function packageStatusChange($packageId) {
        $response = $this->internetService->statusChange($packageId);
        return $response;
    }

    public function deletePackage($packageId = 0) {

        $response = $this->internetService->deletePackage($packageId);
        return $response;
    }

}
