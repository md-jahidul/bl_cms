<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\MetaTag;
use App\Models\ShortCode;

class FixedPageController extends Controller
{
    public function index()
    {   
        $pages = Page::all();
        return view('admin.pages.fixed.index', compact('pages'));
    }

    public function metaTagsEdit($id)
    {
        $metatags = MetaTag::find($id);
        return view('admin.pages.fixed.metatags', compact('metatags'));
    }

    public function metaTagsUpdate($id)
    {
        $metatags = MetaTag::find($id);
        return view('admin.pages.fixed.metatags', compact('metatags'));
    }

    public function components($id)
    {
        $shortcodes = ShortCode::find($id);
        return view('admin.pages.fixed.components', compact('shortcodes'));
    }
}
