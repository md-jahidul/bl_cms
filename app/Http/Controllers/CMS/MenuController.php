<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreMenuRequest;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
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
     * MenuController constructor.
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function getBreadcrumbInfo($parent_id)
    {
        $temp = (new Menu)->find($parent_id, ['id','name','parent_id'])->toArray();
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
        $menus = Menu::where('parent_id', $parent_id)->orderBy('display_order', 'ASC')->get();
        $menu_id = $parent_id;

        while ( $menu_id != 0 ){
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }

        $menu_items = $this->menuItems;
        return view('admin.menu.index', compact('menus','parent_id','menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = 0)
    {
        $this->menuItems[] = ['name' => 'Create'];
        $menu_id = $parent_id;
        while ( $menu_id != 0 ){
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }

        $menu_items = $this->menuItems;
        return view('admin.menu.create', compact('parent_id','menu_items'));
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
        return redirect( ($parentId == 0) ? '/menu' : "/menu/$parentId/child-menu");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function parentMenuSortable(Request $request){
        return $this->menuService->tableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->menuService->findOrFail($id);


        $this->menuItems[] = ['name' => $menu->name];

        $menu_id = $menu->parent_id;
        while ( $menu_id != 0 ){
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }

        $menu_items = $this->menuItems;
        return view('admin.menu.edit', compact('menu','menu_items'));
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
        return redirect( ($parentId != 0) ? "menu/$parentId/child-menu" : 'menu' );
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
        Session::flash('message', $response->getContent());
        return redirect(($parentId == 0) ? '/menu' : "/menu/$parentId/child-menu");
    }
}
