<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlBannerService;
use App\Services\Assetlite\ComponentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ExploreCDetailsController extends Controller
{
    
    public const PAGE_TYPE = "explore_c";

    protected $componentService;
    protected $alBannerService;
    protected $exploreCDetailsService;

    public function __construct(ComponentService $componentService, AlBannerService $alBannerService)
    {
        $this->componentService = $componentService;
        $this->alBannerService = $alBannerService;
    }


    /**
     * @param $tab_type
     * @param $explore_c_id
     * @return Application|Factory|View
     */
    public function index($explore_c_id)
    {
        
        // return "List";
        // $this->info["section_list"] = $this->exploreCDetailsService->sectionList($explore_c_id);
        // $this->info["productDetail"] = $this->appServiceProduct->detailsProduct($explore_c_id);
        // $this->info["fixedSectionData"] = $this->info["section_list"]['fixed_section'];
        // $listAction = [0 => 'explore-c-component.list', 1 => $explore_c_id];

        $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
        $components = $this->componentService->findBy(['page_type' => self::PAGE_TYPE, 'section_details_id' => $explore_c_id], '', $orderBy);
        $banner = $this->alBannerService->findBanner(self::PAGE_TYPE, $explore_c_id);

        return view('admin.explore-c.details.details', compact('components', 'banner'));
    }

    public function componentCreate()
    {
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $storeAction = 'explore-c-component.store';
        $listAction = 'explore-c-component.list';
        $pageType = self::PAGE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction','listAction', 'pageType'));
    }

    public function componentStore(Request $request)
    {
        // return $request->all();
        $explore_c_id = $request->sections['id'];
        $response = $this->componentService->componentStore($request->all(), $explore_c_id , self::PAGE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('explore-c-component/'.$explore_c_id.'/list');
    }

    public function componentEdit(Request $request, $id)
    {
        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components()[self::PAGE_TYPE];
        $updateAction = 'explore-c-component.update';
        $listAction = 'explore-c-component.list';
        return view('admin.components.create', compact('component', 'componentList','listAction', 'updateAction'));
    }

    public function componentUpdate(Request $request, $id)
    {
        $request['page_type'] = self::PAGE_TYPE;
        $explore_c_id = $request->sections['id'];

        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('explore-c-component/'.$explore_c_id.'/list');
    }


    public function componentSortable(Request $request): Response
    {
        return $this->componentService->tableSortable($request->all());
    }

    public function componentDestroy($id)
    {
        $this->componentService->deleteComponent($id);
        // return url('explore-c-component/'.$explore_c_id.'/list');
        return url()->previous();
    }



}
