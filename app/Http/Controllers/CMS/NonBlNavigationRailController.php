<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Services\NonBlNavigationRailService;
use Illuminate\Http\Request;


class NonBlNavigationRailController extends Controller
{

    private $nonblNavigationRailService;
    public function __construct(NonBlNavigationRailService $nonblNavigationRailService)
    {
        $this->nonblNavigationRailService = $nonblNavigationRailService;
        $this->middleware('auth');
    }


    public function index()
    {
        $navigationMenus = $this->nonblNavigationRailService->getNavigationRail();

        return view('admin.nonbl.navigation-rail')->with('navigationMenus', $navigationMenus);
    }


    public function create()
    {
        return view('admin.short_cuts.create');
    }


    public function store(Request $request)
    {
        $response = $this->nonblNavigationRailService->storeNavigationMenu($request->all());
        session()->flash('message', $response->getContent());
        return redirect(route('nonbl-navigation-rail.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $navigationMenus = $this->nonblNavigationRailService->getNavigationRail();
        $navigationMenu = $this->nonblNavigationRailService->findOne($id);
        return view('admin.nonbl.navigation-rail')
            ->with('navigationMenus', $navigationMenus)
            ->with('navigationMenu', $navigationMenu);
    }


    public function update(Request $request, $id)
    {
        $response = $this->nonblNavigationRailService->updateNavigationMenu($request->all(), $id);
        session()->flash('success', $response->getContent());
        return redirect(route('nonbl-navigation-rail.index'));
    }


    public function destroy($id)
    {
        session()->flash('error', $this->nonblNavigationRailService->destroyNavigationMenu($id)->getContent());
        return url(route('nonbl-navigation-rail.index'));
    }


    public function navigationMenuSortable(Request $request)
    {
        $this->nonblNavigationRailService->tableSortable($request);
    }
}
