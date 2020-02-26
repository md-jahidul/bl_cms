<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Component;
use App\Models\ProductDetailsSection;
use App\Services\Assetlite\ComponentService;
use App\Services\Assetlite\ProductDetailsSectionService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProductDetailsController extends Controller
{

    /**
     * @var ProductDetailsSectionService
     */
    protected $productDetailsSectionService;
    /**
     * @var ComponentService
     */
    protected $componentService;

    public function __construct(
        ProductDetailsSectionService $productDetailsSectionService,
        ComponentService $componentService
    ) {
        $this->productDetailsSectionService = $productDetailsSectionService;
        $this->componentService = $componentService;
    }


    /**
     * @param $productDetailsId
     * @return Factory|View
     */
    public function sectionList($productDetailsId)
    {
        $productSections = $this->productDetailsSectionService->findAll();
        return view('admin.other-offer-details.index', compact('productSections', 'productDetailsId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $productDetailsId
     * @return Factory|View
     */
    public function create($productDetailsId)
    {
        return view('admin.other-offer-details.create', compact('productDetailsId'));
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

    public function editSection($productDetailsId, $id)
    {
        $section = $this->productDetailsSectionService->findOne($id);
        return view('admin.other-offer-details.edit', compact('section', 'productDetailsId'));
    }

    public function updateSection(Request $request, $productDetailsId, $id)
    {
        $response = $this->productDetailsSectionService->sectionUpdate($request->all(), $id);
        Session::flash('message', $response->content());
        return redirect(route('section-list', $productDetailsId));
    }

    public function componentList($productDetailsId, $sectionId)
    {
        $components = $this->componentService->componentList($sectionId);
        return view('admin.other-offer-details.components.index', compact('components', 'sectionId', 'productDetailsId'));
    }

    public function componentCreate($productDetailsId, $sectionId)
    {
        return view('admin.other-offer-details.components.create', compact('sectionId', 'productDetailsId'));
    }

    public function componentStore(Request $request, $productDetailsId, $sectionID)
    {
        $response = $this->componentService->componentStore($request->all(), $sectionID);
        Session::flash('success', $response->content());
        return redirect(route('component-list', [$productDetailsId, $sectionID]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $sectionId
     * @param int $id
     * @return Factory|View
     */
    public function componentEdit($productDetailsId, $sectionId, $id)
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

        return view('admin.other-offer-details.components.edit', compact('component', 'multipleImage', 'dataTypes', 'sectionId', 'productDetailsId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $productDetailsId
     * @param $sectionId
     * @param int $id
     * @return Response
     */
    public function componentUpdate(Request $request, $productDetailsId, $sectionId, $id)
    {
        $this->componentService->componentUpdate($request->all(), $id);
        return redirect(route('component-list', [$productDetailsId, $sectionId]));
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
