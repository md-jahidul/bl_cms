<?php

namespace App\Http\Controllers\CMS;

use App\Services\HomeNavigationRailService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ShortCutService;
use App\Http\Requests\ShortCutStoreRequest;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class HomeNavigationRailController extends Controller
{
    /**
     * @var HomeNavigationRailService
     */
    private $homeNavigationRailService;

    /**
     * QuestionController constructor.
     * @param ShortCutService $shortCutService
     */
    public function __construct(HomeNavigationRailService $homeNavigationRailService)
    {
        $this->homeNavigationRailService = $homeNavigationRailService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $navigationMenus = $this->homeNavigationRailService->getNavigationRail();
        return view('admin.mybl-home-components.navigation-rails.index')->with('navigationMenus', $navigationMenus);
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
        $response = $this->homeNavigationRailService->storeNavigationMenu($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('heme-navigation-rail.index'));
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
        $navigationMenus = $this->homeNavigationRailService->getNavigationRail();
        $navigationMenu = $this->homeNavigationRailService->editNavigationMenu($id);
        return view('admin.mybl-home-components.navigation-rails.index')
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
        $response = $this->homeNavigationRailService->updateNavigationMenu($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('heme-navigation-rail.index'));
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
        session()->flash('error', $this->homeNavigationRailService->destroyNavigationMenu($id)->getContent());
        return url(route('heme-navigation-rail.index'));
    }


    public function navigationMenuSortable(Request $request)
    {
        $this->homeNavigationRailService->tableSortable($request);
    }
}
