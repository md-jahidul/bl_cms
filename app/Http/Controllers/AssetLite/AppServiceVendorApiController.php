<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\AppServiceTabRepository;
use App\Services\AppServiceCategoryService;
use App\Services\AppServiceTabService;
use App\Services\AppServiceVendorApiService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AppServiceVendorApiController extends Controller
{
    /**
     * @var AppServiceVendorApiService
     */
    private $appServiceVendorApiService;

    /**
     * AppServiceCategoryController constructor.
     * @param AppServiceVendorApiService $appServiceVendorApiService
     */
    public function __construct(
        AppServiceVendorApiService $appServiceVendorApiService
    ) {
        $this->appServiceVendorApiService = $appServiceVendorApiService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $appServiceVendorApi = $this->appServiceVendorApiService->findAll('', [], [
                'column' => 'created_at',
                'direction' => 'DESC'
            ]);
        return view('admin.app-service.vendor-api.index', compact('appServiceVendorApi'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.app-service.vendor-api.create');
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->appServiceVendorApiService->storeAppServiceVendorApi($request->all());
        Session::flash('message', $response->getContent());
        return redirect('app-service/vendor-api');
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $appServiceVendorApi = $this->appServiceVendorApiService->findOne($id);
        return view('admin.app-service.vendor-api.edit', compact('appServiceVendorApi'));
    }

    /**
     * Update a App Service category items
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $this->appServiceVendorApiService->updateAppServiceVendorApi($request->all(), $id);
        Session::flash('message', 'App Service Category Update successfully!');
        return redirect('app-service/vendor-api');
    }

    /**
     * Delete a App Service category items
     *
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->appServiceVendorApiService->deleteAppServiceVendorApi($id);
        return url('app-service/vendor-api');
    }
}
