<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Component;
use App\Models\ProductDetailsSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function otherOfferDetails($id)
    {
        $productSections = ProductDetailsSection::all();
        return view('admin.other-offer-details.index', compact('productSections', 'id'));
    }

    public function componentList($id)
    {
        $components = Component::all();
        return view('admin.other-offer-details.components.index', compact('components', 'id'));
    }

    public function componentCreate()
    {
//        $components = Component::all();
        return view('admin.other-offer-details.components.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {

        return view('admin.other-offer-details.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function storeSection(Request $request, $id)
    {
        ProductDetailsSection::create($request->all());
        return redirect(route('section-list', $id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
