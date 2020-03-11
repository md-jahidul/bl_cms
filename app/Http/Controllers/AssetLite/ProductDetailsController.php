<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Component;
use App\Models\ProductDetailsSection;
use App\Services\Assetlite\ComponentService;
use App\Services\Assetlite\ProductDetailsSectionService;
use App\Services\ProductService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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

    /**
     * @var ComponentService
     */
    protected $productService;

    protected $dataTypes = [
        'large_title_with_text' => 'Large Title With Text',
        'large_title_text_button' => 'Large Title With Text Button',
        'medium_title_with_text' => 'Medium Title With Text',
        'small_title_with_text' => 'Small Title With Text',
        'text_and_button' => 'Text And Button',
        'special_data_offer' => 'Special Data Offer',
        'bondho_sim_offer' => 'Bondho Sim Offer',
        'startup_offer' => 'Startup offer',
        'table_component' => 'Table Component',

//        'title' => 'Title',
//        'text_area' => 'Text Area',
//        'single_image' => 'Single Image',

        'bullet_text' => 'Bullet Text',
        'accordion_text' => 'Accordion Text',
        'drop_down' => 'Dropdown',
        'multiple_image' => 'Multiple Image'
    ];

    public function __construct(
        ProductDetailsSectionService $productDetailsSectionService,
        ProductService $productService,
        ComponentService $componentService
    ) {
        $this->productDetailsSectionService = $productDetailsSectionService;
        $this->componentService = $componentService;
        $this->productService = $productService;
    }


    /**
     * @param $productDetailsId
     * @return Factory|View
     */
    public function sectionList($productDetailsId)
    {
        $productSections = $this->productDetailsSectionService->findBySection($productDetailsId);
        return view('admin.product.details.index', compact('productSections', 'productDetailsId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $productDetailsId
     * @return Factory|View
     */
    public function create($productDetailsId)
    {
        return view('admin.product.details.create', compact('productDetailsId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function storeSection(Request $request, $id)
    {
        $response = $this->productDetailsSectionService->sectionStore($request->all());
        Session::flash('success', $response->content());
        return redirect(route('section-list', $id));
    }

    public function editSection($productDetailsId, $id)
    {
        $section = $this->productDetailsSectionService->findOne($id);
        return view('admin.product.details.edit', compact('section', 'productDetailsId'));
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
        return view('admin.product.details.components.index', compact('components', 'sectionId', 'productDetailsId'));
    }

    public function componentCreate($productDetailsId, $sectionId)
    {
        $dataTypes = $this->dataTypes;
        $products = $this->productService->produtcs();
        return view('admin.product.details.components.create', compact('sectionId', 'productDetailsId', 'dataTypes', 'products'));
    }

    public function componentStore(Request $request, $productDetailsId, $sectionID)
    {
//        return $request->all();

        $response = $this->componentService->componentStore($request->all(), $sectionID);
        Session::flash('success', $response->content());
        return redirect(route('component-list', [$productDetailsId, $sectionID]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $productDetailsId
     * @param $sectionId
     * @param int $id
     * @return Factory|View
     */
    public function componentEdit($productDetailsId, $sectionId, $id)
    {
        $dataTypes = $this->dataTypes;
        $component = $this->componentService->findOne($id);
        $multipleImage = $component['multiple_attributes'];
        $products = $this->productService->produtcs();

//        return $component;

        return view('admin.product.details.components.edit', compact('component', 'products', 'multipleImage', 'dataTypes', 'sectionId', 'productDetailsId'));
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
     * @param $productDetailsId
     * @param $sectionId
     * @return UrlGenerator|string
     */
    public function sectionDestroy($productDetailsId, $sectionId)
    {
        $this->productDetailsSectionService->sectionDestroy($sectionId);
        return url(route('section-list', $productDetailsId));
    }
}
