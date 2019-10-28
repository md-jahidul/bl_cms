<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\DurationCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DurationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $durationCategories = DurationCategory::all();
        return view('admin.category.duration.index', compact('durationCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DurationCategory  $durationCategory
     * @return Response
     */
    public function show(DurationCategory $durationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DurationCategory  $durationCategory
     * @return Response
     */
    public function edit(DurationCategory $durationCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DurationCategory  $durationCategory
     * @return Response
     */
    public function update(Request $request, DurationCategory $durationCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DurationCategory  $durationCategory
     * @return Response
     */
    public function destroy(DurationCategory $durationCategory)
    {
        //
    }
}
