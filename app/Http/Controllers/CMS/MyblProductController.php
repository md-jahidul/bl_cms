<?php

namespace App\Http\Controllers\CMS;

use App\Models\MyBlProduct;
use App\Models\MyBlProductCategory;
use App\Models\SimCategory;
use App\Http\Controllers\Controller;
use App\Services\MyBlProductService;
use Illuminate\Http\Request;

class MyblProductController extends Controller
{

    /**
     * @var MyBlProductService
     */
    protected $service;

    public function __construct(MyBlProductService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    public function create()
    {
        $sim_types     = SimCategory::all();
        $product_types = MyBlProductCategory::all();

        return view('admin.my-bl-products.create', compact('sim_types', 'product_types'));
    }

    public function searchMissingCoreProductCodes(Request $request)
    {
        $search_term = $request->term;
        $codes = $this->service->searchMissingCoreProductsBykeyword($search_term)->pluck('product_code');

        $data = [];

        foreach ($codes as $code) {
            $data ['results'][] = [
                'id'   => $code,
                'text' => $code,
            ];
        }

        return $data;
    }

    public function store(Request $request)
    {
        $this->service->store($request);

        session()->flash('success', 'Succesfully product added in MyBl');

        return back();
    }
}
