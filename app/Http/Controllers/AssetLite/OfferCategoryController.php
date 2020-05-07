<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\OfferCategoryService;
use Illuminate\View\View;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Validator;

class OfferCategoryController extends Controller {

    private $offerCategoryService;

    /**
     * OfferCategoryController constructor.
     * @param OfferCategoryService $offerCategoryService
     */
    public function __construct(OfferCategoryService $offerCategoryService) {
        $this->offerCategoryService = $offerCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parent_id = 0, $type = null) {
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
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(OfferCategory $offerCategory) {
        //
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id) {
        $offer = OfferCategory::findOrFail($id);
        return view('admin.category.offer.edit', compact('offer'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function childEdit($parent_id, $type, $id) {
        $offer = OfferCategory::findOrFail($id);
        return view('admin.category.offer.child_edit', compact('offer', 'parent_id', 'type'));
    }

    /**
     * @param $id
     * @return Factory|\Illuminate\View\View3
     */
    public function childUpdate(Request $request, $parent_id, $id) {
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
    public function update(Request $request, $id) {
        //$offer = OfferCategory::findOrFail($id);

        $image_upload_size = ConfigController::adminImageUploadSize();
        $image_upload_type = ConfigController::adminImageUploadType();

        # Check Image upload validation
        $validator = Validator::make($request->all(), [
                    'banner_name' => !empty($request->banner_name) ? 'regex:/^\S*$/u' : '',
                    'url_slug' => 'required|regex:/^\S*$/u|unique:offer_categories,url_slug,' . $id,
                    'banner_image_url' => 'mimes:' . $image_upload_type . '|max:' . $image_upload_size // 2M
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect('offer-categories');
        }

        $response = $this->offerCategoryService->updateOfferCategory($request->all(), $id);

//        dd($response);

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
     * @param  \App\Models\OfferCategory  $offerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferCategory $offerCategory) {
        //
    }

}
