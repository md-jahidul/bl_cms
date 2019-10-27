<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SimCategory;
use App\Models\TagCategory;
use App\Services\OfferCategoryService;
use App\Services\ProductService;
use App\Services\TagCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    private $productService;
    private $tagCategoryService;
    private $offerCategoryService;

    /**
     * TagController constructor.
     * @param ProductService $productService
     * @param TagCategoryService $tagCategoryService
     * @param OfferCategoryService $offerCategoryService
     */
    public function __construct(
        ProductService $productService,
        TagCategoryService $tagCategoryService,
        OfferCategoryService $offerCategoryService
    ) {
        $this->productService = $productService;
        $this->tagCategoryService = $tagCategoryService;
        $this->offerCategoryService = $offerCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return Response
     */
    public function index($type)
    {
        $products = Product::category($type)->get();
        return view('admin.product.index', compact('products', 'type'));
    }

    public function trendingOfferHome()
    {
        $trendingHomeOffers = Product::where('is_home', 1)->get();
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
        $type = ucfirst($type);
        $tags = $this->tagCategoryService->findAll();
        $offers = $this->offerCategoryService->findAll();
        return view('admin.product.create', compact('type', 'tags', 'offers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $type
     * @return Response
     */
    public function store(Request $request, $type)
    {
        $simId = SimCategory::where('alias', $type)->first()->id;
        $response = $this->productService->storeProduct($request->all(), $simId);
        Session::flash('message', $response->content());
        return redirect("offers/$type");
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
     * Show the form for editing the specified resource.
     *
     * @param $type
     * @param int $id
     * @return Response
     */
    public function edit($type, $id)
    {
        $product = $this->productService->findOne($id);
        $tags = $this->tagCategoryService->findAll();
        $offers = $this->offerCategoryService->findAll();
        return view('admin.product.edit', compact('product', 'type', 'tags', 'offers'));
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
        $response = $this->productService->updateProduct($request->all(), $id);
        Session::get('message', $response->content());
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
        Session::flash('message', $response->getContent());
        return url("offers/$type");
    }
}
