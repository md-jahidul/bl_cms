<?php

namespace App\Http\Controllers\AssetLite;

use App\Enums\OfferType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\SimCategory;
use App\Models\ProductPriceSlab;
use App\Services\AlBannerService;
use App\Services\AlCoreProductService;
use App\Services\Assetlite\AlInternetOffersCategoryService;
use App\Services\DurationCategoryService;
use App\Services\OfferCategoryService;
use App\Services\ProductDetailService;
use App\Services\ProductService;
use App\Services\TagCategoryService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProductController extends Controller
{

    private $productService;
    private $alCoreProductService;
    private $productDetailService;
    private $tagCategoryService;
    private $offerCategoryService;
    private $durationCategoryService, $alInternetOffersCategoryService;
    protected $info = [];
    /**
     * @var AlBannerService
     */
    private $alBannerService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param AlCoreProductService $alCoreProductService
     * @param ProductDetailService $productDetailService
     * @param TagCategoryService $tagCategoryService
     * @param OfferCategoryService $offerCategoryService
     * @param DurationCategoryService $durationCategoryService
     */
    public function __construct(
        ProductService $productService,
        AlCoreProductService $alCoreProductService,
        ProductDetailService $productDetailService,
        TagCategoryService $tagCategoryService,
        OfferCategoryService $offerCategoryService,
        DurationCategoryService $durationCategoryService,
        AlInternetOffersCategoryService $alInternetOffersCategoryService,
        AlBannerService $alBannerService
    ) {
        $this->productService = $productService;
        $this->alCoreProductService = $alCoreProductService;
        $this->productDetailService = $productDetailService;
        $this->tagCategoryService = $tagCategoryService;
        $this->offerCategoryService = $offerCategoryService;
        $this->durationCategoryService = $durationCategoryService;
        $this->alInternetOffersCategoryService = $alInternetOffersCategoryService;
        $this->alBannerService = $alBannerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return Factory|View
     */
    public function index($type)
    {
        $products = Product::category($type)
            ->with(['offer_category' => function ($query) {
                $query->select('id', 'alias', 'name_en');
            }, 'product_core'])
//            ->select('id', 'product_code', 'offer_category_id', 'name_en', 'show_in_home', 'status')
            ->latest()
            ->get();

        $packageRelatedProduct = $this->offerCategoryService->getRelatedProducts();

        return view('admin.product.index', compact('products', 'type', 'packageRelatedProduct'));
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
     * @return Factory|View
     */
    public function create($type)
    {
        $this->info['productCoreCodes'] = $this->productService->unusedProductCore($type);
        $package_id = SimCategory::where('alias', $type)->first()->id;
        $this->info['type'] = $type;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offers'] = $this->offerCategoryService->getOfferCategories($type);
        $this->info['durations'] = $this->durationCategoryService->findAll();
        $this->info['offerCategory']=$this->alInternetOffersCategoryService->findAll(null,null, [
            'column' => 'sort',
            'direction' => 'ASC'
        ])->where('platform', 'al');
        foreach ($this->info['offers'] as $offer) {
            $child = OfferCategory::where('parent_id', $offer->id)
                ->where('type_id', $package_id)
                ->get();
            if (count($child)) {
                $this->info[$offer->alias . '_offer_child'] = $child;
            }
        }
        // dd($this->info['offerCategory']->toArray());
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
        $validator = Validator::make($request->all(), [
            'url_slug' => 'required|regex:/^\S*$/u|unique:products,url_slug',
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:products,url_slug_bn'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back();
        }
        $this->alInternetOffersCategoryService->storeProductTabs($request->product_code, $request->offer_categories);
        $simId = SimCategory::where('alias', $type)->first()->id;
        $this->alCoreProductService->storeProductCore($request->all(), $simId);
        $this->strToint($request);
        $response = $this->productService->storeProduct($request->all(), $simId);
        dd($response);
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
    public function edit($type, $id)
    {
        $product = $this->productService->findProduct($type, $id);
        $productDetails = $this->productDetailService->findOneDetails($product->id);
        $package_id = SimCategory::where('alias', $type)->first()->id;
        $this->info['previous_page'] = url()->previous();
        $this->info['type'] = $type;
        $this->info['product'] = $product;
        $this->info['productDetails'] = $productDetails;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offersType'] = $this->offerCategoryService->getOfferCategories($type);
        $this->info['durations'] = $this->durationCategoryService->findAll();
        $this->info['offerInfo'] = $product->offer_info;
        $this->info['price_slabs'] = ProductPriceSlab::get();
        $this->info['offerCategory']=$this->alInternetOffersCategoryService->findAll(null,null, [
            'column' => 'sort',
            'direction' => 'ASC'
        ])->where('platform', 'al');
        $this->info['selectedCategory'] = $this->alInternetOffersCategoryService->selectedCategory($product->product_code);

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
        $this->alInternetOffersCategoryService->upSert($request->product_code, $request->offer_categories);

        $product = $this->productService->findProduct($type, $id);

        $validator = Validator::make($request->all(), [
            'url_slug' => 'required|regex:/^\S*$/u|unique:products,url_slug,' . $product->id,
            'product_code' => 'required|unique:products,product_code,'. $product->id

        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back();
        }
        $this->alCoreProductService->updateProductCore($request->all(), $id);
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
    public function productDetailsEdit($type, $id, $offerType)
    {
        $products = $this->productService->findRelatedProduct($type, $id);
        $productDetail = $this->productService->detailsProduct($id);
        $otherAttributes = $productDetail->product_details->other_attributes ?? null;
        $banner = $this->alBannerService->findBanner('product_details', $productDetail->id);
        return view('admin.product.product_details', compact('type', 'productDetail', 'products', 'offerType', 'otherAttributes', 'banner'));
    }

    /**
     * @param Request $request
     * @param $type
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function productDetailsUpdate(Request $request, $type, $id)
    {
//        $request->validate([
//           'banner_name' => !empty($request->banner_name) ? 'regex:/^\S*$/u|unique:product_details,banner_name,' . $id : '',
//           'banner_name_bn' => !empty($request->banner_name_bn) ? 'regex:/^\S*$/u|unique:product_details,banner_name_bn,' . $id : '',
//        ]);

//        $validator = Validator::make($request->all(), [
//            'banner_name' => !empty($request->banner_name) ? 'regex:/^\S*$/u' : '',
//        ]);
//        if ($validator->fails()) {
//            Session::flash('error', $validator->messages()->first());
//        }

        $this->productDetailService->updateOtherRelatedProduct($request, $id);
        $this->productDetailService->updateRelatedProduct($request, $id);
        $response = $this->productDetailService->updateProductDetails($request->all(), $id);


        if ($response['success'] == 1) {
            Session::flash('success', 'Product Details update successfully!');
        } else if ($response['success'] == 2) {
            Session::flash('error', "The banner name is not unique or banner file not found");
        } else {
            Session::flash('error', $response['message']);
        }


        return redirect()->back();
    }

    public function packageRelatedProductStore(Request $request)
    {
        $response = $this->offerCategoryService->storeRelatedProduct($request->all());
        Session::flash('message', $response->content());
        return redirect("offers/$request->type");
    }

    public function existProductCore($productCode)
    {
        return $this->alCoreProductService->findProductCore($productCode);
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
        return response([
            "url" => url("offers/$type"),
            "success" => true
        ]);
    }

    public function  uploadExcel(){

        return view('admin.product.excel_upload');
    }
    public function uploadProductCodeAndSlugByExcel(Request $request){
        try {
            $file = $request->file('product_file');
            $path = $file->storeAs(
                'al-products/' . strtotime(now() . '/'),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            $path = Storage::disk('public')->path($path);

            return $this->alCoreProductService->syncProductCategory($path);

        } catch (\Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }


    /**
     * User: BS(Shuvo)
     * This function is only for bulk keyword update for the search_data Table.
     *
     */

    public function updateSearchDataTable(){
        // return $product = $this->productService->findProduct($type, '100MINS100TAKA');
        $products = $this->productService->findBy();

        foreach ($products as $key => $product) {
            try {
                $this->productService->updateSearchData($product);
            } catch (\Throwable $th) {
                $response = [
                    'success' => 'FAILED',
                    'errors' => $th->getMessage()
                ];
                return response()->json($response, 500);
            }
        }

        return response()->json(['success' => 'Success'], 200);
    }
}
