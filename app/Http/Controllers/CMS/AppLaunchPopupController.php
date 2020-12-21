<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\AppLaunchPopupStoreRequest;
use App\Http\Requests\AppLaunchPopupUpdateRequest;
use App\Models\MyBlAppLaunchPopup;
use App\Services\AppLaunchPopupService;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\MyBlProduct;
use App\Services\ProductCoreService;
use Illuminate\Support\Arr;

/**
 * Class AppLaunchPopupController
 * @package App\Http\Controllers\CMS
 */
class AppLaunchPopupController extends Controller
{
    /**
     * @var AppLaunchPopupService
     */
    private $appLaunchPopupService;

    /**
     * AppLaunchPopupController constructor.
     * @param ProductCoreService $service
     * @param AppLaunchPopupService $appLaunchPopupService
     */
    public function __construct(ProductCoreService $service, AppLaunchPopupService $appLaunchPopupService)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->appLaunchPopupService = $appLaunchPopupService;
    }

    public function create()
    {
        $productList = $this->getActiveProducts();
        $hourSlots = $this->appLaunchPopupService->getHourSlots();
        $page = 'create';

        return view('admin.app-launch-popup.create', compact('productList', 'hourSlots', 'page'));
    }

    /**
     * @param AppLaunchPopupStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AppLaunchPopupStoreRequest $request)
    {
        if ($this->appLaunchPopupService->storeOrUpdate($request->all())) {
            return redirect()->back()->with('success', 'Popup added successfully.');
        }

        return redirect()->back()->with('error', 'Error! Popup not saved.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $popups = MyBlAppLaunchPopup::where('status', 1)->paginate(15);

        return view('admin.app-launch-popup.index', compact('popups'));
    }

    /**
     * @param $popupId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($popupId)
    {
        $popup = $this->appLaunchPopupService->findBy(['id' => $popupId, 'status' =>1])->first();
        if (!$popup) {
            return redirect()->route('app-launch.index')->with('error', 'Error! Popup Not Found');
        }
        $productList = $this->getActiveProducts();
        $dateRange = Carbon::parse($popup->start_date)->format('Y/m/d') . ' - ' .
            Carbon::parse($popup->end_date)->format('Y/m/d');
        $hourSlots = $this->appLaunchPopupService->getHourSlots();
        $page = 'edit';

        return view(
            'admin.app-launch-popup.create',
            compact('popup', 'productList', 'hourSlots', 'page', 'dateRange')
        );
    }

    /**
     * @param AppLaunchPopupUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AppLaunchPopupUpdateRequest $request, $id)
    {
        if ($this->appLaunchPopupService->storeOrUpdate($request->all(), $id)) {
            return redirect()->back()->with('success', 'Popup updated successfully.');
        }
        return redirect()->back()->with('error', 'Error! Popup not updated.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->appLaunchPopupService->findOne($id)->update(['status' => 0]);
        return redirect()->back()->with('success', 'Popup Successfully Deleted');
    }

    public function getActiveProducts()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data', 'voice', 'sms', 'mix']);
            }
        )->get();

        $data = []; //[''=>'Please Select'];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->details->product_code,
                'text' => '(' . strtoupper($product->details->content_type) . ') ' . $product->details->commercial_name_en
            ];
        }

        return $data;
    }
}
