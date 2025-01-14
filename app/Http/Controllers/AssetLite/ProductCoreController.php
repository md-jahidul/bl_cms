<?php

namespace App\Http\Controllers\AssetLite;

use App\Enums\OfferType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\OfferCategory;
use App\Models\OtherRelatedProduct;
use App\Models\Product;
use App\Models\ProductCore;
use App\Models\ProductDetail;
use App\Models\RelatedProduct;
use App\Models\SimCategory;
use App\Models\TagCategory;
use App\Services\DurationCategoryService;
use App\Services\OfferCategoryService;
use App\Services\ProductCoreService;
use App\Services\ProductDetailService;
use App\Services\ProductService;
use App\Services\TagCategoryService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class ProductCoreController extends Controller
{

    private $productService;
    private $productCoreService;
    private $productDetailService;
    private $tagCategoryService;
    private $offerCategoryService;
    private $durationCategoryService;


    protected $info = [];

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param ProductCoreService $productCoreService
     * @param ProductDetailService $productDetailService
     * @param TagCategoryService $tagCategoryService
     * @param OfferCategoryService $offerCategoryService
     * @param DurationCategoryService $durationCategoryService
     */
    public function __construct(
        ProductService $productService,
        ProductCoreService $productCoreService,
        ProductDetailService $productDetailService,
        TagCategoryService $tagCategoryService,
        OfferCategoryService $offerCategoryService,
        DurationCategoryService $durationCategoryService
    ) {
        $this->productService = $productService;
        $this->productCoreService = $productCoreService;
        $this->productDetailService = $productDetailService;
        $this->tagCategoryService = $tagCategoryService;
        $this->offerCategoryService = $offerCategoryService;
        $this->durationCategoryService = $durationCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $products = ProductCore::latest()->get();

        return view('admin.product_core.index', compact('products'));
    }

    public function trendingOfferHome()
    {
        $trendingHomeOffers = Product::where('show_in_home', 1)
            ->with(['product_core' => function ($query) {
                $query->select('product_code', 'activation_ussd', 'mrp_price');
            }, 'offer_category' => function ($query) {
                $query->select('id', 'name_en');
            }])
            ->orderBy('display_order')
            ->get();

        return view('admin.product.home', compact('trendingHomeOffers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return Response
     */

    public function create($type)
    {
        $this->info['productCoreCodes'] = $this->productService->unusedProductCore();
        $package_id = SimCategory::where('alias', $type)->first()->id;
        $this->info['type'] = $type;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offers'] = $this->offerCategoryService->getOfferCategories($type);
        $this->info['durations'] = $this->durationCategoryService->findAll();

        foreach ($this->info['offers'] as $offer) {
            $child = OfferCategory::where('parent_id', $offer->id)
                ->where('type_id', $package_id)
                ->get();
            if (count($child)) {
                $this->info[$offer->alias . '_offer_child'] = $child;
            }
        }
        return view('admin.product.create', $this->info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $jsonKey
     * @return void
     */

    public function strToint($request, $jsonKey = "offer_info")
    {
        if (!empty($request->offer_info)) {
            foreach ($request->offer_info as $key => $info) {
                $data[$jsonKey][$key] = is_numeric($info) ? (int)$info : $info;
                $request->merge($data);
            }
        }
    }

    /**
     * @param ProductStoreRequest $request
     * @param $type
     * @return RedirectResponse|Redirector
     */
    public function store(ProductStoreRequest $request, $type)
    {
        $bondhoSimOffer = $this->productService->findBondhoSim();
        if (count($bondhoSimOffer) > 4 && isset($request->offer_info['other_offer_type_id']) == OfferType::BONDHO_SIM_OFFER) {
            Session::flash('error', 'Maximum 4 Bondho SIM offer can be created');
            return redirect()->back();
        }
        $simId = SimCategory::where('alias', $type)->first()->id;
        $this->productCoreService->storeProductCore($request->all(), $simId);
        $this->strToint($request);
        $response = $this->productService->storeProduct($request->all(), $simId);
        Session::flash('success', $response->content());
        return redirect("offers/$type");
    }

    /**
     * @param Request $request
     */
    public function trendingOfferSortable(Request $request)
    {
        $this->productService->tableSortable($request);
    }

    /**
     * Display the specified resource.
     *
     * @param $type
     * @param int $id
     * @return Response
     */
    public function show($type, $id)
    {
        $productDetails = $this->productService->findOne($id);
        return view('admin.product.show', compact('productDetails', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $type
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $product = $this->productCoreService->findProductCore($id);
        $sim_package = SimCategory::where('id', $product->sim_type)->first();
        dd(SimCategory::latest()->all()->name);
        $package_id = $sim_package->id;

        $this->info['previous_page'] = url()->previous();
        $this->info['type'] = $sim_package->alias;
        $this->info['product'] = $product;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offersType'] = $this->offerCategoryService->getOfferCategories($sim_package->alias);
        $this->info['durations'] = $this->durationCategoryService->findAll();
        $this->info['sim_type'] = SimCategory::latest()->get()->name;
        foreach ($this->info['offersType'] as $offer) {
            $child = OfferCategory::where('parent_id', $offer->id)
                ->where('type_id', $package_id)
                ->get();
            if (count($child)) {
                $this->info[$offer->alias . '_offer_child'] = $child;
            }
        }
        return view('admin.product_core.edit', $this->info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $type
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $type, $id)
    {
        $this->productCoreService->updateProductCore($request->all(), $id);
        $this->strToint($request);
        $response = $this->productService->updateProduct($request->all(), $type, $id);
        Session::flash('message', $response->content());
        return (strpos(request()->previous_page, 'trending-home') !== false) ? redirect(request()->previous_page) : redirect(route('product.list', $type));
    }

    /**
     * @param $type
     * @param $id
     * @return Factory|View
     */
    public function productDetailsEdit($type, $id)
    {
        $products = $this->productService->findRelatedProduct($type, $id);
        $productDetail = $this->productService->detailsProduct($id);
        return view('admin.product.product_details', compact('type', 'productDetail', 'products'));
    }

    /**
     * @param Request $request
     * @param $type
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function productDetailsUpdate(Request $request, $type, $id)
    {
        //$productDetails = $this->productDetailService->findOne($request->product_details_id);

        $this->productDetailService->updateOtherRelatedProduct($request, $id);
        $this->productDetailService->updateRelatedProduct($request, $id);

        $this->productDetailService->updateProductDetails($request->all(), $id);

        Session::flash('success', 'Product Details update successfully!');
        return redirect("offers/$type");
    }

    public function existProductCore($productCode)
    {
        return $this->productCoreService->findProductCore($productCode);
    }

    /**
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($type, $id)
    {
        $response = $this->productService->deleteProduct($id);
        Session::flash('error', $response->getContent());
        return url("offers/$type");
    }

    /**
     * @param $type
     * @return string
     * Product Core Data mapping To Product table
     */
    public function coreDataMappingProduct($type)
    {
        $this->productService->coreData();
        return \response([
            "url" => url("offers/$type"),
            "success" => true
        ]);
    }

    // TODO: Temporary use this methods for Product Details
//    public function updateDetails()
//    {
//        $products = Product::all();
//        ProductDetail::truncate();
//        foreach ($products as $product) {
//            ProductDetail::create([
//                'product_id' => $product->id
//            ]);
//        }
//        return "Insert Successfully";
//    }
}
