<?php

namespace App\Services;

use App\Models\MyBlProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyBlProductService
{
    /**
     * @var ProductCoreService
     */
    protected $productCoreService;

    public function __construct(ProductCoreService $productCoreService)
    {
        $this->productCoreService = $productCoreService;
    }

    public function searchMissingCoreProductsBykeyword($keyword)
    {
        return DB::table('product_cores AS t1')
                        ->select('t1.*')
                        ->where('t1.product_code', 'like', '%' . $keyword . '%')
                        ->leftJoin('my_bl_products AS t2', 't2.product_code', '=', 't1.product_code')
                        ->whereNull('t2.product_code')->get();
    }

    public function store(Request $request)
    {
        return MyBlProduct::create([
            'product_code' => $request->product_code,
            'tag'         => $request->product_tag,
            'description' => $request->product_description,
        ]);
    }
}
