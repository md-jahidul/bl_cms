<?php

namespace App\Http\Controllers\AssetLite\MyPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyBlPlanProductRequest;
use App\Services\MyPlan\MyPlanProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class MyPlanProductController extends Controller
{
    /**
     * @var MyPlanProductService
     */
    protected $myBlPlanProductService;

    /**
     * MyPlanProductController constructor.
     * @param MyPlanProductService $myBlPlanProductService
     */
    public function __construct(MyPlanProductService $myBlPlanProductService)
    {
        $this->myBlPlanProductService = $myBlPlanProductService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myBlPlanProducts = $this->myBlPlanProductService->findAll(null, null, ['column' => 'id', 'direction' => 'desc']);
        $defaultProduct = $myBlPlanProducts->where('is_default', 1)->first();

        return view('admin.my-plan.product.index', compact('myBlPlanProducts', 'defaultProduct'));
    }

    public function create()
    {
        $page = "create";
        return view('admin.my-plan.product.form', compact('page'));
    }

    public function store(MyBlPlanProductRequest $request)
    {
        if ($request->has("is_default")) {
            $default = $this->myBlPlanProductService->findBy(['is_default' => 1])->first();
            if ($default) {
                $default->update(['is_default' => 0]);
            }
        }

        $this->myBlPlanProductService->save($request->all());

        Redis::del("mybl_plan_prepaid_products");

        return redirect()->route('my-plan.products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $page = "edit";
        $product = $this->myBlPlanProductService->findOne($id);

        return view('admin.my-plan.product.form', compact('product', 'page'));
    }

    public function update(MyBlPlanProductRequest $request, $id)
    {
        if ($request->has("is_default")) {
            $default = $this->myBlPlanProductService->findBy(['is_default' => 1])->first();
            if ($default) {
                $default->update(['is_default' => 0]);
            }
        }

        $this->myBlPlanProductService->findOne($id)->update($request->all());

        Redis::del("mybl_plan_prepaid_products");

        return redirect()->route('my-plan.products')->with('success', 'Product updated successfully');
    }

    public function uploadPlanProductExcel(Request $request)
    {
        try {
            $file = $request->file('product_file');
            $path = $file->storeAs(
                'my-plan-products/' . strtotime(now() . '/'),
                "products_" . now() . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->myBlPlanProductService->uploadProductExcel($path);

            Redis::del("mybl_plan_prepaid_products");

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            Log::channel('myblPlanLog')->info("MyBL Plan Product Upload Failed: " . $e->getMessage());
            return response()->json($response, 500);
        }
    }

    public function downloadPlanProducts()
    {
        try {
            return $this->myBlPlanProductService->downloadPlanProducts();
        } catch (Exception $e) {
            Log::info("MyBL Plan Product Download Failed: " . $e->getMessage());
        }

    }
}
