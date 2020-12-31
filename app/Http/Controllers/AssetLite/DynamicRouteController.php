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
     * @var DynamicPageService
     */
    private $dynamicPageService;

    /**
     * DynamicRouteService constructor.
     * @param DynamicRouteService $dynamicRouteService
     * @param DynamicPageService $dynamicPageService
     */
    public function __construct(
        DynamicRouteService $dynamicRouteService,
        DynamicPageService $dynamicPageService
    ) {
        $this->dynamicRouteService = $dynamicRouteService;
        $this->dynamicPageService = $dynamicPageService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $routes = FrontEndDynamicRoute::latest()->get();
//        $routes = $this->dynamicRouteService->findAll();
        return view('admin.dynamic-route.index', compact('routes'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $dynamicPages = $this->dynamicPageService->findAll();
        return view('admin.dynamic-route.create', compact('dynamicPages'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function store(Request $request)
    {
        $response = $this->dynamicRouteService->saveRoute($request->all());
        if ($response) {
            session()->flash('success', $response->getContent());
            return redirect(route('dynamic-routes.index'));
        }
        session()->flash('message', "Failed! Please try again");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $dynamicPages = $this->dynamicPageService->findAll();
        $route = $this->dynamicRouteService->findOne($id);
//        dd($dynamicPages);
        return view('admin.dynamic-route.edit', compact('route', 'dynamicPages'));
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
             return redirect(route('dynamic-routes.index'));
        }
        session()->flash('message', "Failed! Please try again");
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     */
    public function destroy($id)
    {
        $response = $this->dynamicRouteService->deleteDynamicRoute($id);
        Session::flash('message', $response->getContent());
        return url(route('dynamic-routes.index'));
    }
}
