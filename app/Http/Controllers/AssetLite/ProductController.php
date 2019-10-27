<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TagCategory;
use App\Services\OfferCategoryService;
use App\Services\ProductService;
use App\Services\TagCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $products = Product::category($type)->paginate(15);

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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
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
