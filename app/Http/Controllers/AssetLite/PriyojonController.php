<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Priyojon;
use App\Services\AboutPageService;
use App\Services\PriyojonService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
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
    public function update(Request $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->priyojonService->updatePriyojon($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "priyojon/$parentId/child-menu" : 'priyojon');
    }

    /**
     * @param $slug
     * @return Factory|View
     */
    public function aboutPageView($slug)
    {
        $details = $this->aboutPageService->findAboutDetail($slug);

//        dd($details);
        return view('admin.about-pages.about_page', compact('slug', 'details'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function aboutPageUpdate(Request $request)
    {
        $response = $this->aboutPageService->updateAboutPage($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('about-page', $request->slug));
    }
}
