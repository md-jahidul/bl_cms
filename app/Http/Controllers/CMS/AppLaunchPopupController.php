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
    public function __construct(ProductCoreService $service, AppLaunchPopupService $appLaunchPopupService) {
        $this->middleware('auth');
        $this->service = $service;
        $this->appLaunchPopupService = $appLaunchPopupService;
    }

    public function create()
    {
        $productList = $this->getActiveProducts();//ProductCore::where('status', 1)->pluck('name','product_code')->toArray();
        $hourSlots = $this->appLaunchPopupService->getHourSlots();

        return view('admin.app-launch-popup.create', compact('productList', 'hourSlots'));
    }

    /**
     * @param AppLaunchPopupStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AppLaunchPopupStoreRequest $request)
    {
        //dd($request->all());
        if ($this->appLaunchPopupService->store($request->all())) {
            return redirect()->back()->with('success', 'Popup added successfully.');
        } else {
            return redirect()->back()->with('error', 'Error! Popup not saved.');
        }
    }

    public function index()
    {
        $pop_ups = MyBlAppLaunchPopup::paginate(15);

        return view('admin.app-launch-popup.index', compact('pop_ups'));
    }

    public function edit(MyBlAppLaunchPopup $pop_up)
    {
        $empty = ['' => 'Please Select'];
        $productList = $this->getActiveProducts();//ProductCore::where('status', 1)->pluck('name','product_code')->toArray();
        return view('admin.app-launch-popup.edit', compact('pop_up', 'productList'));
    }

    public function update(AppLaunchPopupUpdateRequest $request, $id)
    {
        $all = $request->all();
        $type = $request->type;
        if ($type == 'image') {
            if ($request->hasFile('content_data')) {
                // upload the image
                $file = $request->content_data;
                $path = $file->storeAs(
                    'app-launch-popup/images',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );

                $data['content'] = $path;
            }
        } elseif ($type == 'purchase') {
            if ($request->hasFile('content_data')) {
                // upload the image
                $file = $request->content_data;
                $path = $file->storeAs(
                    'app-launch-popup/images',
                    strtotime(now()) . '.' . $file->getClientOriginalExtension(),
                    'public'
                );

                $data['content'] = $path;
            }
        } else {
            $data['content'] = $request->input('content_data');
        }

        $date_range_array = explode('-', $request->input('display_period'));
        $data['start_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))
            ->toDateTimeString();
        $data['end_date'] = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))
            ->toDateTimeString();

        $data['type'] = $type;
        $data['title'] = $request->title;
        if (isset($request->product_code)) {
            $data['product_code'] = $request->product_code;
        }
        $pop_up = MyBlAppLaunchPopup::find($id);

        $pop_up->update($data);

        return redirect()->back()->with('success', 'Successfully Updated');
    }


    public function destroy($id)
    {
        $pop_up = MyBlAppLaunchPopup::findOrFail($id);
        $pop_up->delete();

        return redirect()->back()->with('success', 'Successfully Deleted');
    }

    public function getActiveProducts()
    {
        $builder = new MyBlProduct();
        $builder = $builder->where('status', 1);

        $products = $builder->whereHas(
            'details',
            function ($q) {
                $q->whereIn('content_type', ['data', 'voice', 'sms']);
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
