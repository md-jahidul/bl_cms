<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\SimCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class SimCategoryController
 * package App\Http\Controllers\AssetLite
 */
class SimCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $simCategories = SimCategory::all();
        return view('admin.category.sim.index', compact('simCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @param  \App\Models\SimCategory  $simCategory
     * @return Response
     */
    public function show(SimCategory $simCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimCategory  $simCategory
     * @return Response
     */
    public function edit(SimCategory $simCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimCategory  $simCategory
     * @return Response
     */
    public function update(Request $request, SimCategory $simCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimCategory  $simCategory
     * @return Response
     */
    public function destroy(SimCategory $simCategory)
    {
        //
    }
}
