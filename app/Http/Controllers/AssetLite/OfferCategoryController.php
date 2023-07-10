<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferCategoryRequest;
use App\Models\OfferCategory;
use App\Models\SimCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\OfferCategoryService;
use Illuminate\View\View;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Validator;

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
        $simCategories = SimCategory::all();
        $file = 'index';
        if ($parent_id != 0) {
            $file = 'child';
            $type = OfferCategory::find($parent_id)->name_en;
        }
        return view('admin.category.offer.' . $file, compact('offerCategories', 'simCategories', 'type', 'parent_id'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OfferCategory $offerCategory
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
    public function childEdit($parent_id, $type, $id)
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

        $data['type'] = $request->type;
        $data['name_en'] = $request->name_en;
        $data['name_bn'] = $request->name_bn;
        $data['status'] = $request->status;
        $data['updated_by'] = Auth::id();

        $offer->update($data);
        return redirect("offer-categories/$parent_id/$type");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OfferCategory $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(OfferCategoryRequest $request, $id)
    {
        $response = $this->offerCategoryService->updateOfferCategory($request->all(), $id);

        if ($response['success'] == 1) {
            Session::flash('message', 'Offer Update successfully!');
        } else if ($response['success'] == 2) {
            Session::flash('error', "The banner name is not unique or banner file not found");
        } else {
            Session::flash('error', $response['message']);
        }


        return redirect('offer-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OfferCategory $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferCategory $offerCategory)
    {
        //
    }

}
