<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Priyojon;
use App\Services\AboutPriyojonService;
use App\Services\PriyojonService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PriyojonController extends Controller
{

    /**
     * @var PriyojonService
     * @var AboutPriyojonService
     */
    private $priyojonService;
    private $aboutPriyojonService;

    /**
     * @var array $menuItems
     */
    protected $priyojonItems = [];


    /**
     * PriyojonController constructor.
     * @param PriyojonService $priyojonService
     * @param AboutPriyojonService $aboutPriyojonService
     */
    public function __construct(PriyojonService $priyojonService, AboutPriyojonService $aboutPriyojonService)
    {
        $this->priyojonService = $priyojonService;
        $this->aboutPriyojonService = $aboutPriyojonService;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($parent_id = 0)
    {
        $priyojons = $this->priyojonService->priyojonList($parent_id);
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;
        return view('admin.config.priyojon.index', compact('priyojons', 'parent_id', 'menu_items'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $priyojonLanding = $this->priyojonService->findOne($id);

        $menu_id = $priyojonLanding->parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;

        return view('admin.config.priyojon.edit', compact('priyojonLanding', 'menu_items'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $parentId =  $request->parent_id;
        $response = $this->priyojonService->updatePriyojon($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(($parentId != 0) ? "priyojon/$parentId/child-menu" : 'priyojon');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutPriyojon()
    {
        $details = $this->aboutPriyojonService->findAboutDetail('about_priyojon');
        return view('admin.priyojon.about_priyojon', compact('details'));
    }

    public function aboutPriyojonUpdate(Request $request)
    {
        $response = $this->aboutPriyojonService->updateAboutPriyojon($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('about-priyojon'));
    }
}
