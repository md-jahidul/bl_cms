<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMyblProductRequest;
use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProduct;
use App\Services\ProductCoreService;
use App\Services\ProductTagService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MyblProductEntryController
 * @package App\Http\Controllers\CMS
 */
class MyblProductEntryController extends Controller
{
    /**
     * @var ProductCoreService
     */
    protected $service;
    /**
     * @var ProductTagService
     */
    private $productTagService;

    /**
     * MyblProductEntryController constructor.
     * @param ProductCoreService $service
     * @param ProductTagService $productTagService
     */
    public function __construct(ProductCoreService $service, ProductTagService $productTagService)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->productTagService = $productTagService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function searchProductCodes(Request $request)
    {
        $search_term = $request->term;
        $codes = $this->service->searchProductCodes($search_term)->pluck('product_code');

        $data = [];

        foreach ($codes as $code) {
            $data ['results'][] = [
                'id' => $code,
                'text' => $code,
            ];
        }

        return $data;
    }

    /**
     * @param $product_code
     * @return Factory|View
     */
    public function getProductDetails($product_code)
    {
        $product = MyBlProduct::where('product_code', $product_code)->first();
        if (!$product) {
            throw new NotFoundHttpException();
        }

        $details = $this->service->getProductDetails($product_code);

        $internet_categories = MyBlInternetOffersCategory::all()->pluck('name', 'id')->sortBy('sort');
        $tags = $this->productTagService
            ->findAll(null, null, ['column' => 'priority', 'direction' => 'asc'])
            ->pluck('title', 'id');

        $pinToTopCount = MyBlProduct::where('pin_to_top', 1)->where('status', 1)->count();

        $disablePinToTop = (($pinToTopCount >= config('productMapping.mybl.max_no_of_pin_to_top')) && !$product->pin_to_top);

        return view('admin.my-bl-products.product-details',
            compact('details', 'internet_categories', 'tags', 'disablePinToTop'));
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.my-bl-products.mybl_product_entry');
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $tags = $this->productTagService
            ->findAll(null, null, ['column' => 'priority', 'direction' => 'asc'])
            ->pluck('title', 'id');
        $internet_categories = MyBlInternetOffersCategory::all()->pluck('name', 'id')->sortBy('sort');
        return view('admin.my-bl-products.create-product', compact('tags', 'internet_categories'));
    }

    public function store(UpdateMyblProductRequest $request)
    {
        return $this->service->storeMyblProducts($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadProductByExcel(Request $request)
    {
        try {
            $file = $request->file('product_file');
            $path = $file->storeAs(
                'products/' . strtotime(now() . '/'),
                "products" . '.' . $file->getClientOriginalExtension(),
                'public'
            );

            $path = Storage::disk('public')->path($path);

            $this->service->mapMyBlProduct($path);

            // reset product keys from redis
            $this->service->resetProductRedisKeys();

            $response = [
                'success' => 'SUCCESS'
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => 'FAILED',
                'errors' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getMyblProducts(Request $request)
    {
        return $this->service->getMyblProducts($request);
    }

    /**
     * @param UpdateMyblProductRequest $request
     * @param $product_code
     * @return RedirectResponse
     * @throws \Exception
     */
    public function updateMyblProducts(UpdateMyblProductRequest $request, $product_code)
    {
        return $this->service->updateMyblProducts($request, $product_code);
    }

    /**
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function downloadMyblProducts()
    {
        return $this->service->downloadMyblProducts();
    }
}
