<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ToffeeProduct;
use App\Services\ToffeePremiumProductService;
use App\Services\ToffeeSubscriptionTypeService;
use Illuminate\Http\Request;


class ToffeePremiumProductController extends Controller
{
    protected  $toffeePremiumProductService;
    protected  $toffeeSubscriptionTypeService;
    public function __construct(ToffeePremiumProductService $toffeePremiumProductService, ToffeeSubscriptionTypeService $toffeeSubscriptionTypeService)
    {
        $this->toffeePremiumProductService = $toffeePremiumProductService;
        $this->toffeeSubscriptionTypeService = $toffeeSubscriptionTypeService;

    }

    public function index()
    {
        $toffeePremiumProducts = $this->toffeePremiumProductService->getToffeePremiumProducts();
        return view('admin.toffee-premium-products.index', compact('toffeePremiumProducts'));
    }


    public function create()
    {
        $toffeeSubscriptionTypes = $this->toffeeSubscriptionTypeService
            ->findBy(['status' => 1], null, ['column' => 'created_at', 'direction' => 'asc'])
            ->pluck('subscription_type', 'id');

        $toffeePrepaidProductCodes = ToffeeProduct::where(['connection_type' => 'prepaid', 'status' => 1])->pluck('product_code', 'product_code')->sortBy('sort');

        $toffeePostpaidProductCodes = ToffeeProduct::where(['connection_type' => 'postpaid', 'status' => 1])->pluck('product_code', 'product_code')->sortBy('sort');

        return view('admin.toffee-premium-products.create', compact(
            'toffeeSubscriptionTypes',
            'toffeePrepaidProductCodes',
            'toffeePostpaidProductCodes'
        ));
    }


    public function store(Request $request)
    {
        if (!$request->prepaid_product_codes && !$request->postpaid_product_codes && !$request->available_for_bl_users) {
            session()->flash('error', 'You have to fill at least one field from <b>Prepaid Product Codes, Postpaid Product Codes and Available for BL Users</b>');
            return redirect()->back();
        }

        if($this->toffeePremiumProductService->storeToffeePremiumProduct($request)) {
            session()->flash('message', 'Premium Product Created Successfully');
        } else {
            session()->flash('error', 'Premium Product Created Failed');
        }

        return redirect('toffee-premium-products');
    }


    public function edit($premiumProductId)
    {
        $toffeePremiumProduct = $this->toffeePremiumProductService->findOne($premiumProductId);

        if ($toffeePremiumProduct) {
            $toffeePremiumProduct->prepaid_product_codes = $toffeePremiumProduct->prepaid_product_codes ? explode(',', $toffeePremiumProduct->prepaid_product_codes ) : [];
            $toffeePremiumProduct->postpaid_product_codes = $toffeePremiumProduct->postpaid_product_codes ? explode(',', $toffeePremiumProduct->postpaid_product_codes ) : [];
        }

        $toffeeSubscriptionTypes = $this->toffeeSubscriptionTypeService
            ->findBy(['status' => 1], null, ['column' => 'created_at', 'direction' => 'asc'])
            ->pluck('subscription_type', 'id');

        $toffeePrepaidProductCodes = ToffeeProduct::where(['connection_type' => 'prepaid', 'status' => 1])->pluck('product_code', 'product_code')->sortBy('sort');

        $toffeePostpaidProductCodes = ToffeeProduct::where(['connection_type' => 'postpaid', 'status' => 1])->pluck('product_code', 'product_code')->sortBy('sort');


        return view('admin.toffee-premium-products.edit', compact(
            'toffeePremiumProduct',
            'toffeeSubscriptionTypes',
            'toffeePrepaidProductCodes',
            'toffeePostpaidProductCodes'
        ));
    }


    public function update(Request $request, $toffeePremiumProduct)
    {
        if (!$request->prepaid_product_codes && !$request->postpaid_product_codes && !$request->available_for_bl_users) {
            session()->flash('error', 'You have to fill at least one field from <b>Prepaid Product Codes, Postpaid Product Codes and Available for BL Users</b>');
            return redirect()->back();
        }
        
        if($this->toffeePremiumProductService->updateToffeePremiumProduct($request, $toffeePremiumProduct)) {
            session()->flash('message', 'Premium Product Updated Successfully');
        } else {
            session()->flash('error', 'Premium Product Updated Failed');
        }

        return redirect('toffee-premium-products');

    }


    public function destroy($toffeePremiumProduct)
    {
        $toffeePremiumProduct = $this->toffeePremiumProductService->findOne($toffeePremiumProduct);

        if ($toffeePremiumProduct) {
            $this->toffeePremiumProductService->deleteToffeePremiumProduct($toffeePremiumProduct->id);
            
            session()->flash('error', 'Premium Product Deleted Successfully');
        } else {
            session()->flash('error', 'Premium Product Deleted Failed');
        }

        return redirect()->back();
    }
}
