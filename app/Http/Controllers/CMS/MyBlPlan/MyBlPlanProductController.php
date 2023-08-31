<?php

namespace App\Http\Controllers\CMS\MyBlPlan;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyBlPlanProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Services\MyBlPlan\MyBlPlanProductService;

class MyBlPlanProductController extends Controller
{
    /**
     * @var MyBlPlanProductService
     */
    protected $myBlPlanProductService;

    /**
     * MyBlPlanProductController constructor.
     * @param MyBlPlanProductService $myBlPlanProductService
     */
    public function __construct(MyBlPlanProductService $myBlPlanProductService)
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

        return view('admin.mybl-plan.product.index', compact('myBlPlanProducts', 'defaultProduct'));
    }

    public function create()
    {
        $page = "create";
        return view('admin.mybl-plan.product.form', compact('page'));
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

        return redirect()->route('mybl-plan.products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $page = "edit";
        $product = $this->myBlPlanProductService->findOne($id);

        return view('admin.mybl-plan.product.form', compact('product', 'page'));
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

        return redirect()->route('mybl-plan.products')->with('success', 'Product updated successfully');
    }

    public function uploadPlanProductExcel(Request $request)
    {
        try {
            $file = $request->file('product_file');
            $path = $file->storeAs(
                'mybl-plan-products/' . strtotime(now() . '/'),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->myBlPlanProductService->uploadProductExcel($path);

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            Log::info("MyBL Plan Product Upload Failed: " . $e->getMessage());
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
