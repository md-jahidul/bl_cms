<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use App\Services\AdTechService;
use App\Services\DynamicRouteService;
use App\Services\MenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class

MenuController extends Controller
{
    /**
     * @var $menuService
     */
    private $menuService;

    /**
     * @var array $menuItems
     */
    protected $menuItems = [];
    /**
     * @var DynamicRouteService
     */
    private $dynamicRouteService;
    /**
     * @var AdTechService
     */
    private $adTechService;

    /**
     * MenuController constructor.
     * @param MenuService $menuService
     * @param DynamicRouteService $dynamicRouteService
     */
    public function __construct(
        MenuService $menuService,
        DynamicRouteService $dynamicRouteService,
        AdTechService $adTechService
    ) {
        $this->menuService = $menuService;
        $this->dynamicRouteService = $dynamicRouteService;
        $this->adTechService = $adTechService;
        $this->middleware('auth');
    }

    public function getBreadcrumbInfo($parent_id)
    {
        $temp = (new Menu())->find($parent_id, ['id','en_label_text','parent_id'])->toArray();
        $this->menuItems[] = $temp;
        return $temp['parent_id'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = 0)
    {
//        return "Index page";

        $menus = $this->menuService->menuList($parent_id);
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->menuItems;
        $adTech = $this->adTechService->getAdTechByRefType('header-menu');
        return view('admin.menu.index', compact('menus', 'parent_id', 'menu_items', 'adTech'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = 0)
    {
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        $this->menuItems[] = ['en_label_text' => 'Create'];
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }

        $menu_items = $this->menuItems;
        return view('admin.menu.create', compact('parent_id', 'menu_items', 'dynamicRoutes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $parentId = $request->parent_id;
        $response = $this->menuService->storeMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect(($parentId == 0) ? '/menu' : "/menu/$parentId/child-menu");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function parentMenuSortable(Request $request)
    {
        return $this->menuService->tableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        $menu = $this->menuService->findOrFail($id);
        $this->menuItems[] = ['en_label_text' => $menu->en_label_text];
        $menu_id = $menu->parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->menuItems;
        return view('admin.menu.edit', compact('menu', 'menu_items', 'dynamicRoutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->menuService->updateMenu($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "menu/$parentId/child-menu" : 'menu');
    }

    /**
     *
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($parentId, $id)
    {
        $response = $this->menuService->deleteMenu($id);
        return ($response['parent_id'] == 0) ? url('menu') : url("/menu/" . $response['parent_id'] . "/child-menu");
    }

    public function adTechStore(Request $request)
    {
        $response = $this->adTechService->storeAdTech($request->all(), 'header-menu');
        Session::flash('message', $response->getContent());
        return redirect('menu');
    }
}
