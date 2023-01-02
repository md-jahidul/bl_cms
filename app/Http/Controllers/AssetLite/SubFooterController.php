<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreFooterMenuRequest;
use App\Models\FooterMenu;
use App\Models\Menu;
use App\Services\DynamicPageService;
use App\Services\DynamicRouteService;
use App\Services\FooterMenuService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SubFooterController extends Controller
{
    /**
     * @var FooterMenuService
     */
    private $footerMenuService;

    /**
     * @var DynamicPageService
     */
    private $dynamicRouteService;

    /**
     * @var array $menuItems
     */
    protected $footerMenuItems = [];

    /**
     * FooterMenuController constructor.
     * @param FooterMenuService $footerMenuService
     * @param DynamicRouteService $dynamicRouteService
     */
    public function __construct(
        FooterMenuService $footerMenuService,
        DynamicRouteService $dynamicRouteService
    ) {
        $this->footerMenuService = $footerMenuService;
        $this->dynamicRouteService = $dynamicRouteService;
        $this->middleware('auth');
    }

    /**
     * @param $parent_id
     * @return mixed
     */
    public function getBreadcrumbInfo($parent_id)
    {
        $temp = (new FooterMenu())->find($parent_id, ['id','en_label_text','parent_id'])->toArray();
        $this->footerMenuItems[] = $temp;
        return $temp['parent_id'];
    }


    /**
     * Display a listing of the resource.
     *
     * @param int $parent_id
     * @param bool $chield_menu
     * @return Response
     */
    public function index($parent_id = 0, $chield_menu = false)
    {
        $footerMenus = $this->footerMenuService->footerMenuList($parent_id);
        $footer_menu_id = $parent_id;
        while ($footer_menu_id != 0) {
            $footer_menu_id = $this->getBreadcrumbInfo($footer_menu_id);
        }
        $footer_menu_items = $this->footerMenuItems;

        return view('admin.footer-menu.index', compact('footerMenus', 'parent_id', 'footer_menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $parent_id
     * @return Application|Factory|View
     */
    public function create($parent_id = 0)
    {
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        $this->footerMenuItems[] = ['en_label_text' => 'Create'];
        $footer_menu_id = $parent_id;
        while ($footer_menu_id != 0) {
            $footer_menu_id = $this->getBreadcrumbInfo($footer_menu_id);
        }
        $footer_menu_items = $this->footerMenuItems;
        return view('admin.footer-menu.create', compact('parent_id', 'footer_menu_items', 'dynamicRoutes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreFooterMenuRequest $request)
    {
        $parentId = $request->parent_id;
        $response = $this->footerMenuService->storeFooterMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect(($parentId == 0) ? '/footer-menu' : "/footer-menu/$parentId/child-footer");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $footerMenu = $this->footerMenuService->findOrFail($id);
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        $this->footerMenuItems[] = ['en_label_text' => $footerMenu->en_label_text];

        $footer_menu_id = $footerMenu->parent_id;
        while ($footer_menu_id != 0) {
            $footer_menu_id = $this->getBreadcrumbInfo($footer_menu_id);
        }
        $footer_menu_items = $this->footerMenuItems;
        return view('admin.footer-menu.edit', compact('footerMenu', 'footer_menu_items', 'dynamicRoutes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreFooterMenuRequest $request)
    {
        $parentId =  $request->parent_id;
        $response = $this->footerMenuService->updateFooterMenu($request->all());
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "footer-menu/$parentId/child-footer" : 'footer-menu');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function FooterMenuSortable(Request $request)
    {
        return $this->footerMenuService->tableSort($request);
    }

    /**
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($parentId, $id)
    {
        $response = $this->footerMenuService->deleteFooterMenu($id);
        return ($response['parent_id'] == 0) ? url('footer-menu') : url("/footer-menu/" . $response['parent_id'] . "/child-footer");
    }
}
