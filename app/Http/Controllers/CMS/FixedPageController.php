<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\MetaTag;
use App\Models\ShortCode;

class FixedPageController extends Controller
{
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
        $metatags = MetaTag::find($id);
        return view('admin.pages.fixed.metatags', compact('metatags'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function metaTagsUpdate($id)
    {
        $metatags = MetaTag::find($id);
        return view('admin.pages.fixed.metatags', compact('metatags'));
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

        return redirect()->route('fixed-page-components',$pageId);
    }
}
