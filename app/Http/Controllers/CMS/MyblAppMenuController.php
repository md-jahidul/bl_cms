<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
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
use App\Services\MyblSliderImageService;

class MyblAppMenuController extends Controller
{
    /**
     * @var MyblAppMenuService
     */
    private $menuService;
    private $sliderImageService;


    /**
     * MyblAppMenuController constructor.
     */
    public function __construct(
        MyblAppMenuService $menuService,
        MyblSliderImageService $sliderImageService
    ) {
        $this->menuService = $menuService;
        $this->sliderImageService = $sliderImageService;

    }

//    public function getBreadcrumbInfo($parent_id)
//    {
//        $temp = (new Menu())->find($parent_id, ['id','en_label_text','parent_id'])->toArray();
//        $this->menuItems[] = $temp;
//        return $temp['parent_id'];
//    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($parent_id = 0)
    {
        $menus = $this->menuService->menuList($parent_id);
        $parentMenu = $this->menuService->findOne($parent_id);
        return view('admin.mybl-menu.index', compact('menus', 'parent_id', 'parentMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create($parent_id = 0)
    {
        $parentMenu = $this->menuService->findOne($parent_id);
        $ctaActions = Helper::navigationActionList();
        $deeplinkActions = Helper::deepLinkList();
        return view('admin.mybl-menu.create', compact('parent_id', 'parentMenu', 'ctaActions', 'deeplinkActions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MyblAppMenuRequest $request
     * @return Application|Redirector|RedirectResponse
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
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $menu = $this->menuService->findOrFail($id);
        $ctaActions = Helper::navigationActionList();
        $deeplinkActions = Helper::deepLinkList();
        $products = $this->sliderImageService->getActiveProducts();
        return view('admin.mybl-menu.edit', compact('menu', 'ctaActions', 'deeplinkActions', 'products'));
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
        $this->menuService->deleteMenu($id);
        return ($parentId == 0) ? url('mybl-menu') : url("mybl-menu/" . $parentId . "/child-menu");
    }
}
