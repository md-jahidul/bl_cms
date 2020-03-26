<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\RoamingBundleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RoamingBundleController extends Controller
{
    /**
     * @var RoamingBundleService
     */
    private $roamingBundleService;

    /**
     * BusinessInternetController constructor.
     * @param RoamingBundleService $roamingBundleService
     */
    public function __construct(RoamingBundleService $roamingBundleService)
    {
        $this->roamingBundleService = $roamingBundleService;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.roaming.bundle_list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadBundleExcel(Request $request)
    {
        return $this->roamingBundleService->saveExcel($request);
    }


    /**
     * @return Factory|View
     */
    public function bundleCreate()
    {
        return view('admin.roaming.bundle_create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function bundleStore(Request $request)
    {
        $response = $this->roamingBundleService->saveBundle($request);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Bundle is saved!');
        } else {
            Session::flash('error', 'Bundle saving process failed!');
        }
        return redirect('/roaming/bundle');
    }


    /**
     * @param $bundleId
     * @return Factory|View
     */
    public function bundleEdit($bundleId)
    {
        $bundle = $this->roamingBundleService->findOne($bundleId);
        return view('admin.roaming.bundle_edit', compact('bundle'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function updateBundle(Request $request, $id)
    {
        $response = $this->roamingBundleService->updateBundle($request, $id);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Package is updated!');
        } else {
            Session::flash('error', 'Package updating process failed!');
        }
        return redirect('/roaming/bundle');
    }


    public function roamingBundleList(Request $request)
    {
        return $this->roamingBundleService->getRoamingBundle($request);
    }

    public function bundleStatusChange($id)
    {
        return $this->roamingBundleService->statusChange($id);
    }

    public function allBundleDelete()
    {
        return $this->roamingBundleService->deleteBundleAll();
    }

    public function deleteBundle($bundleId = 0)
    {
        return $this->roamingBundleService->deleteBundle($bundleId);
    }
}
