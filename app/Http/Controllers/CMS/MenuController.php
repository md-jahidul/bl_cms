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


    private function getInfo($id){
        return (new Menu)->find($id, ['id','name','parent_id']);
    }


    public function getBradcamInfo($parent_id)
    {
        $temp = (new Menu)->find($parent_id, ['id','name','parent_id']);
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
            $menu_id = $this->getBradcamInfo($menu_id);
        }

        $liHtml = '';
        for($i = count($this->menuItems) - 1; $i >= 0; $i--){
            $liHtml .= '<li class="breadcrumb-item active">' .  $this->menuItems[$i]['name']  . '</li>';
        }

        return view('admin.menu.index', compact('menus','parent_id','liHtml'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parent_id = 0)
    {
        return view('admin.menu.create', compact('parent_id'));
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
        return view('admin.menu.edit', compact('menu'));
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
