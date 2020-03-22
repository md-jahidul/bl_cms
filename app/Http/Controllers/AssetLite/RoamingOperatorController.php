<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\BusinessInternetService;
use App\Services\RoamingOperatorService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Session;

class RoamingOperatorController extends Controller
{

    /**
     * @var RoamingOperatorService
     */
    private $roamingOperatorService;

    /**
     * BusinessInternetController constructor.
     * @param RoamingOperatorService $roamingOperatorService
     */
    public function __construct(RoamingOperatorService $roamingOperatorService)
    {
        $this->roamingOperatorService = $roamingOperatorService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.roaming.operator.list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadOperatorExcel(Request $request)
    {
        return $this->roamingOperatorService->saveExcel($request);
    }


    /**
     * Internet Create Form
     *
     * @param NA
     * @return Factory|View
     * @Bulbul Mahmud Nito || 12/03/2020
     */
//    public function internetCreate() {
//        $otherPorducts = $this->internetService->getAllPackage();
//        $tags = $this->internetService->getTags();
//        return view('admin.business.internet_package_create', compact('otherPorducts', 'tags'));
//    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
//    public function saveInternetPackage(Request $request) {
//
//        $response = $this->internetService->saveInternet($request);
//
//        if ($response['success'] == 1) {
//            Session::flash('sussess', 'Package is saved!');
//        } else {
//            Session::flash('error', 'Package saving process failed!');
//        }
//
//        return redirect('/business-internet');
//    }


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
    public function updateInternetPackage(Request $request) {

        $response = $this->internetService->updateInternet($request);

//        dd($response);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Package is updated!');
        } else {
            Session::flash('error', 'Package updating process failed!');
        }

        return redirect('/business-internet');
    }


    public function roamingOperatorList(Request $request)
    {
        $response = $this->roamingOperatorService->getRoamingOperators($request);

//        dd($response);
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
