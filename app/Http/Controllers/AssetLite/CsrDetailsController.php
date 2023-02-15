<?php

namespace App\Http\Controllers\AssetLite;

use App\Helpers\ComponentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdTechService;
use App\Services\AlBannerService;
use App\Services\Assetlite\ComponentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class CsrDetailsController extends Controller
{

    protected const REFERENCE_TYPE = "csr";

    protected $componentService;
    protected $adTechService;
    protected $exploreCDetailsService;

    public function __construct(ComponentService $componentService, AdTechService $adTechService)
    {
        $this->componentService = $componentService;
        $this->adTechService = $adTechService;
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
        $adTech = $this->adTechService->getAdTechByRefType(self::REFERENCE_TYPE, $blog_id);

        // return request()->blog_id;


        return view('admin.al-csr.post.details', compact('components', 'adTech'));
    }

    public function componentCreate()
    {
        $componentList = ComponentHelper::components()['blog'];
        $storeAction = 'csr-component.store';
        $listAction = 'csr-component.list';
        $pageType = self::REFERENCE_TYPE;
        return view('admin.components.create', compact('componentList', 'storeAction', 'listAction', 'pageType'));
    }

    public function componentStore(Request $request)
    {
        $blog_id = $request->sections['id'];
        $response = $this->componentService->componentStore($request->all(), $blog_id , self::REFERENCE_TYPE);
        Session::flash('message', $response->getContent());
        return redirect('csr-component/'.$blog_id.'/list');
    }

    public function componentEdit(Request $request, $id)
    {
        $component = $this->componentService->findOne($id);
        $componentList = ComponentHelper::components()['blog'];
        $updateAction = 'csr-component.update';
        $listAction = 'csr-component.list';
        return view('admin.components.edit', compact('component', 'componentList', 'updateAction', 'listAction'));
    }

    public function componentUpdate(Request $request, $id)
    {
        // return $request->all();
        $request['page_type'] = self::REFERENCE_TYPE;
        $blog_id = $request->sections['id'];

        $response = $this->componentService->componentUpdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('csr-component/'.$blog_id.'/list');
    }


    public function componentSortable(Request $request): Response
    {
        return $this->componentService->tableSortable($request->all());
    }

    public function componentDestroy($id)
    {
        $this->componentService->deleteComponent($id);
        // return url('csr-component/'.$blog_id.'/list');
        return url()->previous();
    }

    public function adTechStore(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $blog_id = $request->reference_id;

        $response = $this->adTechService->storeAdTech($request->all(), self::REFERENCE_TYPE, $blog_id);
        Session::flash('message', $response->getContent());
        return redirect('csr-component/'.$blog_id.'/list');
    }



}
