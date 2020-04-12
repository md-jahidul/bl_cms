<?php

namespace App\Http\Controllers\CMS\Search;

use App\Http\Requests\StoreInAppSearchContentRequest;
use App\Models\MyBlSearchContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class InAppSearchContentController
 * @package App\Http\Controllers\CMS\Search
 */
class InAppSearchContentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.my-bl-search.content_entry');
    }

    /**
     * @param  StoreInAppSearchContentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreInAppSearchContentRequest $request)
    {
        try{
            MyBlSearchContent::create([
                'display_title' => $request->display_title,
                'description' => $request->description,
                'search_content' => json_encode($request->search_content),
                'navigate_action' => $request->navigation_action,
                'other_contents' => isset($request->other_info) ? json_encode([
                    'type' => strtolower($request->navigation_action),
                    'content' => $request->other_info
                ]) : null,
            ]);


            return redirect()->route('search-content.index')->with('success', 'New Search content added');
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
