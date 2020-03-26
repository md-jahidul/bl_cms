<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\RoamingRateService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RoamingRateController extends Controller
{
    /**
     * @var RoamingRateService
     */
    private $roamingRateService;

    /**
     * BusinessInternetController constructor.
     * @param RoamingRateService $roamingRateService
     */
    public function __construct(RoamingRateService $roamingRateService)
    {
        $this->roamingRateService = $roamingRateService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.roaming.rates_list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadRatesExcel(Request $request)
    {
        return $this->roamingRateService->saveExcel($request);
    }


    /**
     * @return Factory|View
     */
    public function ratesCreate()
    {
        return view('admin.roaming.rates_create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function ratesStore(Request $request)
    {
        $response = $this->roamingRateService->saveRate($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Rate is saved!');
        } else {
            Session::flash('error', 'Rate saving process failed!');
        }
        return redirect('/roaming/rates');
    }


    /**
     * @param $ratesId
     * @return Factory|View
     */
    public function ratesEdit($ratesId)
    {
        $rates = $this->roamingRateService->findOne($ratesId);
        return view('admin.roaming.rates_edit', compact('rates'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function updateRate(Request $request, $id)
    {
        $response = $this->roamingRateService->updateRate($request, $id);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Package is updated!');
        } else {
            Session::flash('error', 'Package updating process failed!');
        }
        return redirect('/roaming/rates');
    }


    public function roamingRatesList(Request $request)
    {
        return $this->roamingRateService->getRoamingRates($request);
    }

    public function ratesStatusChange($id)
    {
        return $this->roamingRateService->statusChange($id);
    }


    public function deleteRates($ratesId = 0)
    {
        return $this->roamingRateService->deleteRate($ratesId);
    }
}
