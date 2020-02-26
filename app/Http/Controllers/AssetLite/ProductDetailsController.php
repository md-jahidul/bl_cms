<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Component;
use App\Models\ProductDetailsSection;
use App\Services\Assetlite\ComponentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductDetailsController extends Controller
{

    protected $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function otherOfferDetails($id)
    {
        $productSections = ProductDetailsSection::all();
        return view('admin.other-offer-details.index', compact('productSections', 'id'));
    }

    public function componentList($sectionId)
    {
        $components = $this->componentService->componentList($sectionId);
        return view('admin.other-offer-details.components.index', compact('components', 'sectionId'));
    }

    public function componentCreate($sectionId)
    {
//        return $sectionId;
//        $components = Component::all();
        return view('admin.other-offer-details.components.create', compact('sectionId'));
    }

    public function componentStore(Request $request, $sectionID)
    {
//        dd($request->all());

        $this->componentService->componentStore($request->all(), $sectionID);
        return redirect(route('component-list', $sectionID));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $sectionId
     * @param int $id
     * @return Factory|View
     */
    public function componentEdit($sectionId, $id)
    {
        $dataTypes = [
            'text_area' => 'Text Area',
            'bullet_Text' => 'Bullet Text',
            'accordion_text' => 'Accordion Text',
            'single_image' => 'Single Image',
            'multiple_image' => 'Multiple Image'
        ];
        $component = $this->componentService->findOne($id);
        $multipleImage = $component['multiple_attributes'];

//        return $multipleImage;

        return view('admin.other-offer-details.components.edit', compact('component', 'multipleImage', 'dataTypes', 'sectionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $sectionId
     * @param int $id
     * @return Response
     */
    public function componentUpdate(Request $request, $sectionId, $id)
    {

        $this->componentService->componentUpdate($request->all(), $id);
        return redirect(route('component-list', $sectionId));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create($id)
    {
        return view('admin.other-offer-details.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
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
