<?php

namespace App\Http\Controllers\AssetLite;

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
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
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
     * @param $type
     * @return Response
     */
    public function index($type)
    {

//        $slider->data = DB::table('partner_offers as po')
//            ->where('po.show_in_home',1)
//            ->where('po.is_active',1)
//            ->join('partners as p', 'po.partner_id', '=', 'p.id')
//            ->join('partner_categories as pc', 'p.partner_category_id', '=', 'pc.id') // you may add more joins
//            ->select('po.*', 'pc.name_en AS offer_type_en', 'pc.name_bn AS offer_type_bn', 'p.company_name_en','p.company_name_bn','p.company_logo')
//            ->orderBy('po.display_order')
//            ->get();

//        $products = DB::table('products')
//            ->join('product_cores as pc', 'products.product_code', '=', 'pc.product_code')
//            ->join('offer_categories as oc', 'pc.product_type_id', '=', 'oc.id') // you may add more joins
//            ->select('products.*', 'pc.id as product_core_id','pc.*', 'oc.name_en as offer_type', 'oc.alias as offer_type_alias')
////            ->orderBy('po.display_order')
//            ->get();

        $products = Product::category($type)->with(['product_core', 'offer_category' => function ($query) {
            $query->select('id', 'name_en');
        }])->get();

//        $products = Product::with('product_core', 'offer_category')->get();

//        return $products;

        return view('admin.product.index', compact('products', 'type'));
    }

    public function trendingOfferHome()
    {
        $trendingHomeOffers = Product::where('show_in_home', 1)->orderBy('display_order')->get();
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

        $this->info['productCoreCodes'] = ProductCore::select('product_code')->get();
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductStoreRequest $request, $type)
    {
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
     * @return Response
     */
    public function edit($type, $id)
    {
        $product = $this->productCoreService->findProductCore($id);

//        return $product->product->offer_info['duration_category_id'];

        $package_id = SimCategory::where('alias', $type)->first()->id;
        $this->info['previous_page'] = url()->previous();
        $this->info['type'] = $type;
        $this->info['product'] = $product;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offersType'] = $this->offerCategoryService->getOfferCategories($type);
        $this->info['durations'] = $this->durationCategoryService->findAll();
        $this->info['offerInfo'] = $product->product['offer_info'];

//        return $this->info;

        foreach ($this->info['offersType'] as $offer) {
            $child = OfferCategory::where('parent_id', $offer->id)
                ->where('type_id', $package_id)
                ->get();
            if (count($child)) {
                $this->info[$offer->alias . '_offer_child'] = $child;
            }
        }
        return view('admin.product.edit', $this->info);
    }

    public function homeEdit($id)
    {
        return view('admin.product.home_offer_edit', compact(''));
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
//        return $request->all();

        $this->productCoreService->updateProductCore($request->all(), $id);

        $this->strToint($request);
        $response = $this->productService->updateProduct($request->all(), $id);
        Session::flash('message', $response->content());
        return (strpos(request()->previous_page, 'trending-home') !== false) ? redirect(request()->previous_page) : redirect(route('product.list', $type));
    }

    /**
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetailsEdit($type, $id)
    {
        $products = $this->productService->findRelatedProduct($type, $id);

        $productDetail = Product::with( 'other_related_product', "related_product", 'product_details')->category($type)->get();

//        $productDetail = $this->productService->findOne($id, [
//            'other_related_product', "related_product", 'product_details', 'product_core'
//        ]);

//        return $productDetail;

        return view('admin.product.product_details', compact('type', 'productDetail', 'products'));
    }

    /**
     * @param Request $request
     * @param $type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function productDetailsUpdate(Request $request, $type, $id)
    {
        $productDetailsId = $request->product_details_id;
        $productDetails = $this->productDetailService->findOne($productDetailsId);
        $this->productDetailService->updateOtherRelatedProduct($request, $id);
        $this->productDetailService->updateRelatedProduct($request, $id);
        $productDetails['other_attributes'] = $request->other_attributes;
        $productDetails->update($request->all());
        return redirect("offers/$type");
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($type, $id)
    {
        $response = $this->productService->deleteProduct($id);
        Session::flash('error', $response->getContent());
        return url("offers/$type");
    }
}
