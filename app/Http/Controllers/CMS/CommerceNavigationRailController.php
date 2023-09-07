<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortCutStoreRequest;
use App\Models\ContentNavigationRail;
use App\Services\CommerceNavigationRailService;
use App\Services\ContentNavigationRailService;
use App\Services\HomeNavigationRailService;
use App\Services\ShortCutService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CommerceNavigationRailController extends Controller
{

    private $commerceNavigationRailService;
    public function __construct(CommerceNavigationRailService $commerceNavigationRailService)
    {
        $this->commerceNavigationRailService = $commerceNavigationRailService;
    }


    public function index()
    {
        $navigationMenus = $this->commerceNavigationRailService->getNavigationRail();

        return view('admin.mybl-home-components.commerce-navigation-rails.index')->with('navigationMenus', $navigationMenus);
    }


    public function create()
    {
        return view('admin.short_cuts.create');
    }


    public function store(Request $request)
    {
        $response = $this->commerceNavigationRailService->storeNavigationMenu($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('commerce-navigation-rail.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $navigationMenus = $this->commerceNavigationRailService->getNavigationRail();
        $navigationMenu = $this->commerceNavigationRailService->editNavigationMenu($id);
        return view('admin.mybl-home-components.commerce-navigation-rails.index')
            ->with('navigationMenus', $navigationMenus)
            ->with('navigationMenu', $navigationMenu);
    }


    public function update(Request $request, $id)
    {
        $response = $this->commerceNavigationRailService->updateNavigationMenu($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('commerce-navigation-rail.index'));
    }


    public function destroy($id)
    {
        session()->flash('error', $this->commerceNavigationRailService->destroyNavigationMenu($id)->getContent());
        return url(route('commerce-navigation-rail.index'));
    }


    public function navigationMenuSortable(Request $request)
    {
        $this->commerceNavigationRailService->tableSortable($request);
    }
}
