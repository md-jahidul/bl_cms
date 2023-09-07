<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortCutStoreRequest;
use App\Models\ContentNavigationRail;
use App\Services\ContentNavigationRailService;
use App\Services\HomeNavigationRailService;
use App\Services\ShortCutService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ContentNavigationRailController extends Controller
{

    private $contentNavigationRailService;
    public function __construct(ContentNavigationRailService $contentNavigationRailService)
    {
        $this->contentNavigationRailService = $contentNavigationRailService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $navigationMenus = $this->contentNavigationRailService->getNavigationRail();

        return view('admin.mybl-home-components.content-navigation-rails.index')->with('navigationMenus', $navigationMenus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.short_cuts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShortCutStoreRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->contentNavigationRailService->storeNavigationMenu($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('content-navigation-rail.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $navigationMenus = $this->contentNavigationRailService->getNavigationRail();
        $navigationMenu = $this->contentNavigationRailService->editNavigationMenu($id);
        return view('admin.mybl-home-components.content-navigation-rails.index')
            ->with('navigationMenus', $navigationMenus)
            ->with('navigationMenu', $navigationMenu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShortCutStoreRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->contentNavigationRailService->updateNavigationMenu($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('content-navigation-rail.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        session()->flash('error', $this->contentNavigationRailService->destroyNavigationMenu($id)->getContent());
        return url(route('content-navigation-rail.index'));
    }


    public function navigationMenuSortable(Request $request)
    {
        $this->contentNavigationRailService->tableSortable($request);
    }
}
