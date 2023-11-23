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

    public function landingPageSeoSave(Request $request)
    {
        $seoData = Priyojon::where('component_type', 'landing_page_seo')->first();

        $data = [
            'component_type' => "landing_page_seo",
            'page_header' => $request->page_header,
            'page_header_bn' => $request->page_header_bn,
            'schema_markup' => $request->schema_markup
        ];

        if ($seoData) {
            $seoData->update($data);
        }
        Priyojon::create($data);
        Session::flash('success', "SEO data save successfully!!");
        return redirect('priyojon');
    }

    /**
     * @param int $parent_id
     * @return Factory|View
     */
    public function index($parent_id = 0)
    {
        $priyojons = $this->priyojonService->priyojonList($parent_id);
        foreach ($priyojons as $key => $priyojon) {
            /**
             * If type is discount_privilege and is parent then unset this
             */
            if (in_array($priyojon->component_type, ['discount_privilege', 'benefits_for_you']) && $priyojon->parent_id == 0) {
                unset($priyojons[$key]);
            }
        }
        $menu_id = $parent_id;
        while ($menu_id != 0) {
            $menu_id = $this->getBreadcrumbInfo($menu_id);
        }
        $menu_items = $this->priyojonItems;
        $seoData = Priyojon::where('component_type', 'landing_page_seo')->first();

        return view('admin.loyalty-header.index', compact('priyojons', 'parent_id', 'menu_items', 'seoData'));
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
        if (isset($request->about_page) && $request->about_page == "discount-privilege"){
            return redirect('about-page/discount-privilege');
        }
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
