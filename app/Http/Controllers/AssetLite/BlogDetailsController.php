<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlBannerService;
use App\Services\Assetlite\ComponentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class BlogDetailsController extends Controller
{
    
    protected const REFERENCE_TYPE = "blog";

    protected $componentService;
    protected $exploreCDetailsService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }


    /**
     * @param $tab_type
     * @param $blog_id
     * @return Application|Factory|View
     */
    public function index($blog_id)
    {
        
        // return "List";
        // $this->info["section_list"] = $this->exploreCDetailsService->sectionList($blog_id);
        // $this->info["productDetail"] = $this->appServiceProduct->detailsProduct($blog_id);
        // $this->info["fixedSectionData"] = $this->info["section_list"]['fixed_section'];
        // $listAction = [0 => 'explore-c-component.list', 1 => $blog_id];

        $orderBy = ['column' => 'component_order', 'direction' => 'asc'];
        $components = $this->componentService->findBy(['page_type' => self::REFERENCE_TYPE, 'section_details_id' => $blog_id], '', $orderBy);

        return view('admin.blog.post.details', compact('components'));
    }

    public function componentCreate()
    {
        $componentList = ComponentHelper::components();
        $storeAction = 'explore-c-component.store';
        $pageType = self::PAGE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction', 'pageType'));
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
        $componentList = ComponentHelper::components();
        $updateAction = 'explore-c-component.update';
        return view('admin.components.create', compact('component', 'componentList', 'updateAction'));
    }

    public function componentUpdate(Request $request, $id)
    {
        // return $request->all();
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
