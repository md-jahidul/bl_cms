<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\MetaTagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\MetaTag;
use App\Models\ShortCode;
use Illuminate\Support\Facades\Session;

class FixedPageController extends Controller
{

    /**
     * @var $metaTagService
     */
    private $metaTagService;

    public function __construct(MetaTagService $metaTagService)
    {
        $this->metaTagService = $metaTagService;
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.fixed.index', compact('pages'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function metaTagsEdit($id)
    {
        $metaTag = $this->metaTagService->findMetaTag($id);
        return view('admin.pages.fixed.metatags', compact('metaTag'));
    }

    /**
     * @param Request $request
     * @param $pageId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function metaTagsUpdate(Request $request, $pageId, $id)
    {
        $response = $this->metaTagService->updateMetaTag($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("fixed-pages/$pageId/meta-tags");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function components($id)
    {
        $shortCodes = ShortCode::where('page_id', $id)->get();
        $page =  Page::find($id)->title;
        return view('admin.pages.fixed.components', compact('shortCodes', 'page'));
    }


    public function fixedPageStatusUpdate($pageId, $componentId)
    {
        $component = ShortCode::find($componentId);
        $component->is_active = $component->is_active ? 0 : 1;
        $component->save();

        return redirect()->route('fixed-page-components', $pageId);
    }
}
