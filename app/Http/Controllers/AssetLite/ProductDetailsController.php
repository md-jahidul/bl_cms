<?php

namespace App\Http\Controllers\AssetLite;

use App\Models\Component;
use App\Models\ProductDetailsSection;
use App\Services\Assetlite\BannerImgRelatedProductService;
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

    protected const PAGE_TYPE = "product_details";

    /**
     * @var ComponentService
     */
    protected $productService;

    protected $dataTypes = [
        'large_title_with_text' => 'Large Title With Text',
        'large_title_text_button' => 'Large Title With Text And Button',
        'medium_title_with_text' => 'Medium Title With Text',
        'small_title_with_text' => 'Small Title With Text',
        'text_and_button' => 'Text And Button',
        'table_component' => 'Table Component',

        'text_component' => 'Text Component',
        'features_component' => 'Features Component',

//        'single_image' => 'Single Image',

        'bullet_text' => 'Bullet Text',
        'accordion_text' => 'Accordion Text',
        'multiple_image' => 'Multiple Image',
        'drop_down' => 'Dropdown',
        'special_data_offer' => 'Special Data Offer',
        'bondho_sim_offer' => 'Bondho Sim Offer',
        'startup_offer' => 'Startup offer',
    ];
    /**
     * @var BannerImgRelatedProductService
     */
    private $bannerImgRelatedProductService;

    public function __construct(
        ProductDetailsSectionService $productDetailsSectionService,
        BannerImgRelatedProductService $bannerImgRelatedProductService,
        ProductService $productService,
        ComponentService $componentService
    ) {
        $this->productDetailsSectionService = $productDetailsSectionService;
        $this->bannerImgRelatedProductService = $bannerImgRelatedProductService;
        $this->componentService = $componentService;
        $this->productService = $productService;
    }


    /**
     * @param $simType
     * @param $productDetailsId
     * @return Factory|View
     */
    public function sectionList($simType, $productDetailsId)
    {
        $productType = $this->productService->findOne($productDetailsId);
        $productType = $productType->offer_category;
        $products = $this->productService->produtcs();
        $productSections = $this->productDetailsSectionService->findBySection($productDetailsId);
        $bannerRelatedProduct = $this->bannerImgRelatedProductService->findBannerAndRelatedProduct($productDetailsId);
        return view('admin.product.details.index', compact(
            'productSections',
            'simType',
            'productDetailsId',
            'products',
            'productType',
            'bannerRelatedProduct'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $simType
     * @param $productDetailsId
     * @return Factory|View
     */
    public function create($simType, $productDetailsId)
    {
        return view('admin.product.details.create', compact('productDetailsId', 'simType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $simType
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function storeSection(Request $request, $simType, $id)
    {
        $response = $this->productDetailsSectionService->sectionStore($request->all());
        Session::flash('success', $response->content());
        return redirect(route('section-list', [$simType, $id]));
    }

    public function editSection($simType, $productDetailsId, $id)
    {
        $section = $this->productDetailsSectionService->findOne($id);
        return view('admin.product.details.edit', compact('section', 'productDetailsId', 'simType'));
    }

    public function updateSection(Request $request, $simType, $productDetailsId, $id)
    {
        $response = $this->productDetailsSectionService->sectionUpdate($request->all(), $id);
        Session::flash('message', $response->content());
        return redirect(route('section-list', [$simType, $productDetailsId]));
    }

    /**
     * @param $simType
     * @param $productDetailsId
     * @param $sectionId
     * @return Factory|View
     */
    public function componentList($simType, $productDetailsId, $sectionId)
    {
        $components = $this->componentService->componentList($sectionId, 'product_details');
        return view('admin.product.details.components.index', compact('components', 'sectionId','simType', 'productDetailsId'));
    }

    public function componentCreate($simType, $productDetailsId, $sectionId)
    {
        $dataTypes = $this->dataTypes;
        $products = $this->productService->produtcs();
        return view('admin.product.details.components.create', compact('sectionId', 'productDetailsId', 'dataTypes', 'simType', 'products'));
    }

    public function componentStore(Request $request, $simType, $productDetailsId, $sectionID)
    {
        $response = $this->componentService->componentStore($request->all(), $sectionID, self::PAGE_TYPE);
        Session::flash('success', $response->content());
        return redirect(route('component-list', [$simType, $productDetailsId, $sectionID]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $productDetailsId
     * @param $sectionId
     * @param int $id
     * @return Factory|View
     */
    public function componentEdit($simType, $productDetailsId, $sectionId, $id)
    {
        $dataTypes = $this->dataTypes;
        $component = $this->componentService->findOne($id);
        $multipleImage = $component['multiple_attributes'];
        $products = $this->productService->produtcs();
        return view('admin.product.details.components.edit', compact('component', 'products', 'multipleImage', 'dataTypes', 'sectionId', 'simType', 'productDetailsId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $productDetailsId
     * @param $sectionId
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function componentUpdate(Request $request, $simType, $productDetailsId, $sectionId, $id)
    {
        $this->componentService->componentUpdate($request->all(), $id);
        return redirect(route('component-list', [$simType, $productDetailsId, $sectionId]));
    }


    public function bannerImgRelatedPro(Request $request, $simType, $productId)
    {
        $response = $this->bannerImgRelatedProductService->storeImgProduct($request->all(), $productId);
        Session::flash('success', $response->content());
        return redirect(route('section-list', [$simType, $productId]));
    }

    public function sectionSortable(Request $request)
    {
        $this->productDetailsSectionService->tableSortable($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param $simType
     * @param $productDetailsId
     * @param $sectionId
     * @return UrlGenerator|string
     */
    public function sectionDestroy($simType, $productDetailsId, $sectionId)
    {
        $this->productDetailsSectionService->sectionDestroy($sectionId);
        return url(route('section-list', [$simType, $productDetailsId]));
    }

    public function componentSortable(Request $request)
    {
        $this->componentService->tableSortable($request);
    }

    /**
     * @param $productId
     * @param $sectionId
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function componentDestroy($simType, $productId, $sectionId, $id)
    {
        $this->componentService->deleteComponent($id);
        return url(route('component-list', [$simType, $productId, $sectionId]));
    }
}
