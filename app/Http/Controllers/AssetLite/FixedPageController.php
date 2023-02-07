<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\DynamicRouteService;
use App\Services\MetaTagService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\MetaTag;
use App\Models\ShortCode;
use App\Services\Assetlite\ShortCodeService;
use Illuminate\Support\Facades\Session;

class FixedPageController extends Controller
{

    /**
     * @var $metaTagService
     */
    private $metaTagService;
    /**
     * @var DynamicRouteService
     */
    private $dynamicRouteService;
    /**
     * @var ShortCodeService
     */
    private $shortCodeService;

    public function __construct(
        MetaTagService $metaTagService,
        DynamicRouteService $dynamicRouteService,
        ShortCodeService $shortCodeService
    ) {
        $this->metaTagService = $metaTagService;
        $this->dynamicRouteService = $dynamicRouteService;
        $this->shortCodeService = $shortCodeService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeComponent()
    {
        $pages = Page::all();
        return view('admin.pages.fixed.index', compact('pages'));
    }

    public function fixedPageList()
    {
        $pages = $this->metaTagService->findAll();
        return view('admin.pages.fixed-page.index', compact('pages'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fixedPageCreate()
    {
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        return view('admin.pages.fixed-page.create', compact('dynamicRoutes'));
    }

    public function fixedPageStore(Request $request)
    {
        $response = $this->metaTagService->storeFixedPageTag($request->all());
        Session::flash('message', $response->getContent());
        return redirect("fixed-pages");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fixedPageEdit($id)
    {
        $page = $this->metaTagService->findOne($id);
        $dynamicRoutes = $this->dynamicRouteService->findLangWiseRoute();
        return view('admin.pages.fixed-page.edit', compact('page', 'dynamicRoutes'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function fixedPageUpdate(Request $request, $id)
    {
        $response = $this->metaTagService->updateMetaTag($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("fixed-pages");
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function deleteFixedPage($id)
    {
        $response = $this->metaTagService->deleteFixedPage($id);
        Session::flash('message', $response->getContent());
        return url('/fixed-pages');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function components($id)
    {
        $shortCodes = $this->shortCodeService->findBy(['page_id'=> $id],'slider',['column' => 'sequence','direction'=>'ASC']);
        $shortCodes = ShortCode::where('page_id', $id)->with(['slider'=>function($q){
            return $q->with('componentTypes');
        }])->orderBy('sequence', 'ASC')->get();
        //dd($shortCodes->toArray());
        $page =  Page::find($id)->title;
        return view('admin.pages.fixed.components', compact('shortCodes', 'page'));
    }


    public function fixedPageStatusUpdate($pageId, $componentId)
    {
        $component = $this->shortCodeService->findOrFail($componentId);
        $component->is_active = $component->is_active ? 0 : 1;
        $component->save();

        return redirect()->route('fixed-page-components', $pageId);
    }

    public function componentSortable(Request $request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->shortCodeService->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        return "Sorting Success";
    }

    public function editComponents($pageId,$shortCodes){
        //$shortCodes = ShortCode::findOrFail($shortCodes);
        $shortCodes = $this->shortCodeService->findOrFail($shortCodes);
        if($shortCodes){
            $other_attributes = $shortCodes->other_attributes;
        }
        return view('admin.pages.fixed.edit', compact('shortCodes','pageId','other_attributes'));
    }

    public function updateComponents($pageId,ShortCode $shortCode, Request $request){
        $data = $request->all();
        if($data['other_attributes']){
            foreach ($data['other_attributes'] as $key => $val){
                if(is_null($val)){
                    unset($data['other_attributes'][$key]);
                }
            }
        }

        $shortCodes = $shortCode->update($data);
        // ->where(['id'=>$id,'page_id'=>$pageId]);
        //return view('admin.pages.fixed.edit', compact('shortCodes'));
        return redirect()->route('fixed-page-components',$pageId);
    }
}
