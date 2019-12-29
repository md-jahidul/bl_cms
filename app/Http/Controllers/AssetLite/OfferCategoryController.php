<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\OfferCategoryService;
use Illuminate\View\View;

class OfferCategoryController extends Controller
{
    private $offerCategoryService;


    /**
     * OfferCategoryController constructor.
     * @param OfferCategoryService $offerCategoryService
     */
    public function __construct(OfferCategoryService $offerCategoryService)
    {
        $this->offerCategoryService = $offerCategoryService;
    }


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
            $type = OfferCategory::find($parent_id)->name_en;
        }



        return view('admin.category.offer.' . $file, compact('offerCategories', 'type', 'parent_id'));
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
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $offer = OfferCategory::findOrFail($id);
        return view('admin.category.offer.edit', compact('offer'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function childEdit($parent_id,$type,$id)
    {
        $offer = OfferCategory::findOrFail($id);
        return view('admin.category.offer.child_edit', compact('offer', 'parent_id', 'type'));
    }

    /**
     * @param $id
     * @return Factory|\Illuminate\View\View3
     */
    public function childUpdate(Request $request, $parent_id, $id)
    {
        $type = $request->type;
        $offer = OfferCategory::findOrFail($id);
        $offer->update($request->all());
        return redirect("offer-categories/$parent_id/$type");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$offer = OfferCategory::findOrFail($id);
        //$offer->update($request->all());

        $this->offerCategoryService->updateOfferCategory($request->all(), $id);

        Session::flash('message', 'Offer Update successfully!');
        return redirect('offer-categories');
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
