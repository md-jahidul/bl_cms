<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\RelatedProduct;
use App\Models\SimCategory;
use App\Models\TagCategory;
use App\Services\DurationCategoryService;
use App\Services\OfferCategoryService;
use App\Services\ProductService;
use App\Services\TagCategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{

    private $productService;
    private $tagCategoryService;
    private $offerCategoryService;
    private $durationCategoryService;

    protected $info = [];

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param TagCategoryService $tagCategoryService
     * @param OfferCategoryService $offerCategoryService
     * @param DurationCategoryService $durationCategoryService
     */
    public function __construct(
        ProductService $productService,
        TagCategoryService $tagCategoryService,
        OfferCategoryService $offerCategoryService,
        DurationCategoryService $durationCategoryService
    ) {
        $this->productService = $productService;
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
        $mytime = Carbon::now('Asia/Dhaka');
        $dateTime = $mytime->toDateTimeString();
        $currentSecends = strtotime($dateTime);


        $products = Product::category($type)->get();




//        print_r($time_diff);die();

//        $to = date('d/m/Y h:m');
//        $product = Product::first();
//        $fromDate = "2016-10-01";
//        $toDate   = "2016-10-31";
//        $current = Carbon::now('Asia/Dhaka');

//        $reservations = Product::where('start_date', '<=', $time_diff)->where('end_date', '>=', $time_diff)->first();

//        return $products;

//        $new_date = date('Y-m-d H:i:s', $reservations->start_date);

//        return $new_date;

//        $data = Product::whereBetween('start_date', [$product->start_date.' 00:00:00',$product->end_date.' 23:59:59'])
//            ->get();
//
//        return $data;




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

//        return $this->info;

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
        foreach ($request->offer_info as $key => $info) {
            $data[$jsonKey][$key] =  is_numeric($info) ? (int)$info : $info;
            $request->merge($data);
        }
    }

    public function store(Request $request, $type)
    {




        $this->strToint($request)       ;
        $simId = SimCategory::where('alias', $type)->first()->id;
        $response = $this->productService->storeProduct($request->all(), $simId);
        Session::flash('success', $response->content());
        return redirect("offers/$type");
    }

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
        $product = $this->productService->findOne($id);

        $package_id = SimCategory::where('alias', $type)->first()->id;
        $this->info['previous_page'] = url()->previous();
        $this->info['type'] = $type;
        $this->info['product'] = $product;
        $this->info['tags'] = $this->tagCategoryService->findAll();
        $this->info['offersType'] = $this->offerCategoryService->getOfferCategories($type);
        $this->info['durations'] = $this->durationCategoryService->findAll();
        $this->info['offerInfo'] = $product['offer_info'];

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
        $this->strToint($request);
        $response = $this->productService->updateProduct($request->all(), $id);
        Session::flash('message', $response->content());
        return (strpos(request()->previous_page, 'trending-home') !== false) ? redirect(request()->previous_page) : redirect( route('product.list', $type) );
        // return redirect(request()->previous_page);
    }

    public function productDetailsEdit($type, $id)
    {
        $products = $this->productService->findRelatedProduct($type, $id);
        $productDetail = $this->productService->findOne($id, ["related_product", 'product_details']);
        return view('admin.product.product_details', compact('type', 'productDetail', 'products'));
    }

    public function productDetailsUpdate(Request $request, $type, $id)
    {
        $productDetailsId = $request->product_details_id;
        $productDetails = ProductDetail::findOrFail($productDetailsId);

        $products = RelatedProduct::where('product_id', $id)->get();

        if (count($products) > 0)
        {
            foreach ($products as $product) {
                $productId = RelatedProduct::findOrFail($product->id);
                $productId->delete();
            }
        }

        foreach (request()->related_product_id as $item) {
            RelatedProduct::create([
                'product_id' => $id,
                'related_product_id' => $item
            ]);
        }

        $productDetails->update([
            'balance_check' => $request->balance_check,
            'details'       => $request->details,
            'offer_details'       => $request->offer_details
        ]);

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
