<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Http\Request;

class OfferCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = 0, $type = null)
    {
        // $type = OfferCategory::find($parent_id)->name;
        $offerCategories = OfferCategory::where('parent_id', $parent_id)->with('type')->get();


        $file = 'index';
        if ($parent_id != 0) {
            $file = 'child';
            $type = OfferCategory::find($parent_id)->name;
        }

        return view('admin.category.offer.' . $file, compact('offerCategories', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(OfferCategory $offerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferCategory $offerCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferCategory $offerCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferCategory $offerCategory)
    {
        //
    }
}
