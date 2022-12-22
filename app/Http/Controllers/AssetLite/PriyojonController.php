<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\PriyojonRequest;
use App\Models\Priyojon;
use App\Services\AboutPageService;
use App\Services\PriyojonService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PriyojonController extends Controller
{

    /**
     * @var PriyojonService
     * @var AboutPageService
     */
    private $priyojonService;
    private $aboutPageService;

    /**
     * @var array $menuItems
     */
    protected $priyojonItems = [];


    /**
     * PriyojonController constructor.
     * @param PriyojonService $priyojonService
     * @param AboutPageService $aboutPageService
     */
    public function __construct(PriyojonService $priyojonService, AboutPageService $aboutPageService)
    {
        $this->priyojonService = $priyojonService;
        $this->aboutPageService = $aboutPageService;
        $this->middleware('auth');
    }

    public function getBreadcrumbInfo($parent_id)
    {
        $temp = (new Priyojon())->find($parent_id, ['id','title_en','parent_id'])->toArray();
        $this->priyojonItems[] = $temp;
        return $temp['parent_id'];
    }

    /**
     * @param int $parent_id
     * @return Factory|View
     */
    public function index($parent_id = 0)
    {
        $priyojons = $this->priyojonService->priyojonList($parent_id);
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;
        return view('admin.loyalty-header.index', compact('priyojons', 'parent_id', 'menu_items'));
    }

    public function create($parent_id = 0)
    {
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;

        return view('admin.loyalty-header.create', compact('menu_items', 'parent_id'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function store(PriyojonRequest $request)
    {
        $parentId =  $request->parent_id;
        $response = $this->priyojonService->storePriyojon($request->all());
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "priyojon/$parentId/child-menu" : 'priyojon');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $priyojonLanding = $this->priyojonService->findOne($id);

        $menu_id = $priyojonLanding->parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;
        return view('admin.loyalty-header.edit', compact('priyojonLanding', 'menu_items'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(PriyojonRequest $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->priyojonService->updatePriyojon($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "priyojon/$parentId/child-menu" : 'priyojon');
    }

    public function landingPageBanner(Request $request, $id)
    {
        $request->validate([
            'banner_name' => 'unique:priyojons,banner_name,' . $id,
            'banner_name_bn' => 'unique:priyojons,banner_name_bn,' . $id,
        ]);

        $parentId =  $request->parent_id;
        $response = $this->priyojonService->bannerUpload($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "priyojon/$parentId/child-menu" : 'priyojon');
    }

    public function destroyMenu($parentId, $id)
    {
        $this->priyojonService->deleteMenu($id);
        return url("priyojon/$parentId/child-menu");
    }
}
