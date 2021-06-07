<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\MyblAppMenuRequest;
use App\Services\MyblAppMenuService;
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

class MyblAppMenuController extends Controller
{
    /**
     * @var MyblAppMenuService
     */
    private $menuService;

    /**
     * MyblAppMenuController constructor.
     */
    public function __construct(
        MyblAppMenuService $menuService
    ) {
        $this->menuService = $menuService;
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
     * @return Application|Factory|View
     */
    public function index($parent_id = 0)
    {
        $data = $this->menuService->menuList($parent_id);
        $menus = $data['menus'];
        $menu_items = $data['menu_items'];
//        dd(!empty($menu_items));
        return view('admin.mybl-menu.index', compact('menus', 'parent_id', 'menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($parent_id = 0)
    {
        $this->menuItems[] = ['title_en' => 'Create'];
//        $menu_id = $parent_id;
//        while ($menu_id != 0) {
//            $menu_id = $this->getBreadcrumbInfo($menu_id);
//        }
        $menu_items = $this->menuItems;
        return view('admin.mybl-menu.create', compact('parent_id', 'menu_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(MyblAppMenuRequest $request)
    {
        $parentId = $request->parent_id;
        $response = $this->menuService->storeMenu($request->all());
        Session::flash('success', $response->getContent());
        return redirect(($parentId == 0) ? 'mybl-menu' : "mybl-menu/$parentId/child-menu");
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function parentMenuSortable(Request $request)
    {
        return $this->menuService->tableSort($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $menu = $this->menuService->findOrFail($id);
        $this->menuItems[] = ['title_en' => $menu->title_en];
//        $menu_id = $menu->parent_id;
//        while ($menu_id != 0) {
//            $menu_id = $this->getBreadcrumbInfo($menu_id);
//        }
        $menu_items = $this->menuItems;
        return view('admin.mybl-menu.edit', compact('menu', 'menu_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MyblAppMenuRequest $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(MyblAppMenuRequest $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->menuService->updateMenu($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "mybl-menu/$parentId/child-menu" : 'mybl-menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|string|UrlGenerator
     */
    public function destroy($parentId, $id)
    {
        $response = $this->menuService->deleteMenu($id);
        return ($parentId == 0) ? url('mybl-menu') : url("mybl-menu/" . $parentId . "/child-menu");
    }
}
