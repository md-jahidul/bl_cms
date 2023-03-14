<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMyblProductRequest;
use App\Models\MyBlInternetOffersCategory;
use App\Models\MyBlProduct;
use App\Repositories\MyBlProductRepository;
use App\Repositories\MyBlProductSchedulerRepository;
use App\Services\BaseMsisdnService;
use App\Services\FreeProductPurchaseReportService;
use App\Services\MyBlProductSchedulerService;
use App\Services\ProductCoreService;
use App\Services\ProductTagService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
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
    private $productTagService, $myblProductRepository;
    private $baseMsisdnService;
    /**
     * @var FreeProductPurchaseReportService
     */
    private $freeProductPurchaseReportService;

    /**
     * MyblProductEntryController constructor.
     * @param ProductCoreService $service
     * @param ProductTagService $productTagService
     */
    private $myblProductScheduleRepository, $myBlProductSchedulerService;
    public function __construct(
        ProductCoreService $service,
        ProductTagService $productTagService,
        BaseMsisdnService $baseMsisdnService,
        FreeProductPurchaseReportService $freeProductPurchaseReportService,
        MyBlProductSchedulerRepository $myblProductScheduleRepository,
        MyBlProductSchedulerService $myBlProductSchedulerService,
        MyBlProductRepository $myblProductRepository
    ) {
        $this->middleware('auth');
        $this->service = $service;
        $this->productTagService = $productTagService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->freeProductPurchaseReportService = $freeProductPurchaseReportService;
        $this->myblProductScheduleRepository = $myblProductScheduleRepository;
        $this->myBlProductSchedulerService = $myBlProductSchedulerService;
        $this->myblProductRepository = $myblProductRepository;
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

        $internet_categories = MyBlInternetOffersCategory::where('platform', 'mybl')->pluck('name', 'id')->sortBy('sort');

        $tags = $this->productTagService
            ->findAll(null, null, ['column' => 'priority', 'direction' => 'asc'])
            ->pluck('title', 'id');

        $pinToTopCount = MyBlProduct::where('pin_to_top', 1)->where('status', 1)->count();
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $disablePinToTop = (($pinToTopCount >= config('productMapping.mybl.max_no_of_pin_to_top')) && !$product->pin_to_top);
        $productSchedulerData = $this->myblProductScheduleRepository->findActiveScheduleDataByProductCode($product_code);

        $productScheduleRunning = false;
        $warningText = "";

        if(!is_null($productSchedulerData)) {
            $currentTime = Carbon::parse()->format('Y-m-d H:i:s');
//            dd($currentTime >= $productSchedulerData->start_date && $currentTime <= $productSchedulerData->end_date && !$productSchedulerData->change_state_status && $productSchedulerData->is_cancel);
            if(($currentTime >= $productSchedulerData->start_date && $currentTime <= $productSchedulerData->end_date && (!$productSchedulerData->change_state_status || !$productSchedulerData->product_core_change_state_status) && $productSchedulerData->is_cancel == 0)) {
                $productScheduleRunning = true;
                $warningText = "Schedule will be start.";
            }

            if(($currentTime >= $productSchedulerData->start_date && $currentTime <= $productSchedulerData->end_date && ($productSchedulerData->change_state_status || $productSchedulerData->product_core_change_state_status) && $productSchedulerData->is_cancel == 0)) {
                $productScheduleRunning = true;
                $warningText = "Schedule is running.";
            }

            if($productSchedulerData->change_state_status && !$productScheduleRunning && $productSchedulerData->is_cancel == 0) {
                $productScheduleRunning = true;
                $warningText = "It has not been reverted yet. ";
            }

            if ($productSchedulerData->start_date > $currentTime && !$productScheduleRunning && $productSchedulerData->is_cancel == 0) {
                $productScheduleRunning = true;
                $warningText = "Schedule will be start.";
            }
        }

        return view(
            'admin.my-bl-products.product-details',
            compact('details', 'internet_categories', 'tags', 'disablePinToTop', 'baseMsisdnGroups', 'productSchedulerData', 'productScheduleRunning', 'warningText')
        );
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.my-bl-products.mybl_product_entry');
    }

    public function inactiveProducts(Request $request)
    {
        $inactiveProducts = $this->service->getInactiveProducts();
        return view('admin.my-bl-products.inactive_products', compact('inactiveProducts'));
    }

    public function activateProduct($productCode)
    {
        if ($this->service->activateProduct($productCode)) {
            Session::flash('success', 'Product activated! Please find the product in product list');
        } else {
            Session::flash('success', 'Error while activating! Please retry');
        }

        return redirect()->back();
    }
    /**
     * @return Factory|View
     */
    public function create()
    {
        $tags = $this->productTagService
            ->findAll(null, null, ['column' => 'priority', 'direction' => 'asc'])
            ->pluck('title', 'id');
        $internet_categories = MyBlInternetOffersCategory::where('platform', 'mybl')->pluck('name', 'id')->sortBy('sort');

        $pinToTopCount = MyBlProduct::where('pin_to_top', 1)->where('status', 1)->count();
        $disablePinToTop = (($pinToTopCount >= config('productMapping.mybl.max_no_of_pin_to_top')));
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view(
            'admin.my-bl-products.create-product',
            compact(
                'tags',
                'internet_categories',
                'disablePinToTop',
                'baseMsisdnGroups'
            )
        );
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
            /**
             * Commenting reset redis key code according to BL requirement on 24 June 2021
             */
            //$this->service->resetProductRedisKeys();
            $this->service->syncSearch();

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

    public function resetRedisProductKey()
    {
        //dd(in_array(\Carbon\Carbon::now()->format('H'), [0, 1, 2, 3]));
        $this->service->resetProductRedisKeys();
        return redirect()->back()->with('success', 'Redis key reset is successful!');
    }

    public function imageRemove($id)
    {
        return $this->service->imgRemove($id);
    }

    public function freeProductPurchaseReport(Request $request)
    {
        $purchasedProducts = $this->freeProductPurchaseReportService->analyticsData($request->all());
        return view('admin.free-product-analytic.purchase-product', compact('purchasedProducts'));
    }

    public function purchaseDetails(Request $request, $purchaseProductId)
    {
        if ($request->ajax()) {
            return $this->freeProductPurchaseReportService->msisdnPurchaseDetails($request, $purchaseProductId);
        }
        $purchaseProduct = $this->freeProductPurchaseReportService->findOne($purchaseProductId);
        return view('admin.free-product-analytic.purchase-msisdn', compact('purchaseProduct'));
    }

    public function getScheduleProduct()
    {
        $currentTime = Carbon::parse()->format('Y-m-d H:i:s');
        $scheduleProducts = $this->myblProductScheduleRepository->getAllScheduleProducts();

        return view('admin.my-bl-products.schedule-products', compact('scheduleProducts', 'currentTime'));
    }

    public function getScheduleProductRevert($id)
    {

        return $this->myBlProductSchedulerService->cancelSchedule($id);
    }

    public function scheduleProductsView($id)
    {
        $scheduleProduct = $this->myblProductScheduleRepository->findOne($id);

        $productCode = $scheduleProduct['product_code'];
        $product = $this->myblProductRepository->findByProperties(['product_code' => $productCode], ['media', 'show_in_home', 'pin_to_top', 'base_msisdn_group_id', 'tag', 'is_visible']);
        $product = $product->first();

        $productCore = $this->service->findBy(['product_code' => $productCode]);
        $productCore = $productCore->first();

        $tagTitleForScheduler = null;
        $baseMsisdnTitleForSchedule = null;
        $baseMsisdnTitleForProduct = null;

        if(!is_null($scheduleProduct['tags'])) {
            $tagIds = json_decode($scheduleProduct['tags']);
            $tag = $this->myBlProductSchedulerService->getTag($tagIds[0]);
            $tagTitleForScheduler = $tag->title;
        }

        if(!is_null($scheduleProduct['base_msisdn_group_id'])) {
            $baseMsisdnTitleForSchedule = $this->baseMsisdnService->getMsisdnGroupTitle($scheduleProduct['base_msisdn_group_id']);
        }


        if(!is_null($product['base_msisdn_group_id'])) {

            $baseMsisdnTitleForProduct = $this->baseMsisdnService->getMsisdnGroupTitle($product['base_msisdn_group_id']);
        }

        $productScheduleRunning = false;

        $currentTime = Carbon::parse()->format('Y-m-d H:i:s');
        if (($currentTime >= $scheduleProduct->start_date && $currentTime <= $scheduleProduct->end_date && $scheduleProduct->change_state_status)) {
            $productScheduleRunning = true;
        }

        return view('admin.my-bl-products.schedule-product-view', compact('scheduleProduct', 'product', 'tagTitleForScheduler', 'baseMsisdnTitleForSchedule', 'baseMsisdnTitleForProduct', 'productScheduleRunning', 'productCore'));
    }

    public function redisKeyUpdateView()
    {
        return view('admin.my-bl-products.new-product-redis-key-update');
    }

    public function redisKeyUpdate()
    {
        Redis::set('new_product_upload_time', Carbon::now()->timestamp);
        Session::flash('message', 'Redis Key Update');

        return redirect('redis-key-update-view');

    }
}
