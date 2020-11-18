<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreSliderImageRequest;
use App\Models\AboutUsBanglalink;
use App\Models\FrontEndDynamicRoute;
use App\Services\AboutUsService;
use App\Services\AlSliderImageService;
use App\Services\AlSliderService;
use App\Services\DynamicPageService;
use App\Services\DynamicRouteService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DynamicRouteController extends Controller
{
    /**
     * @var DynamicRouteService
     */
    private $dynamicRouteService;

    /**
     * DynamicRouteService constructor.
     * @param DynamicRouteService $dynamicRouteService
     */
    public function __construct(
        DynamicRouteService $dynamicRouteService
    ) {
        $this->dynamicRouteService = $dynamicRouteService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $routes = $this->dynamicRouteService->findAll();
        return view('admin.dynamic-route.index', compact('routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $route = $this->dynamicRouteService->findOne($id);
        return view('admin.dynamic-route.edit', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->dynamicRouteService->updateRoute($request, $id);

        if ($response) {
             session()->flash('success', $response->getContent());
             return redirect(route('dynamic-routes.list'));
        }
        session()->flash('message', "Failed! Please try again");
    }
}
