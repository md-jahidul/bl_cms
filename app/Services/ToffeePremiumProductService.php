<?php

namespace App\Services;

use App\Repositories\ToffeePremiumProductRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ToffeePremiumProductService
{
    use CrudTrait;
    use FileTrait;

    protected $toffeePremiumProductRepository;

    public function __construct(ToffeePremiumProductRepository $toffeePremiumProductRepository)
    {
        $this->toffeePremiumProductRepository = $toffeePremiumProductRepository;
        $this->setActionRepository($toffeePremiumProductRepository);
    }

    public function getToffeePremiumProducts()
    {
        return $this->toffeePremiumProductRepository->findAll();
    }

    public function storeToffeePremiumProduct($request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = [];
                $data['toffee_subscription_type_id'] = $request->toffee_subscription_type_id;
                $data['prepaid_product_codes'] = ($request->has('prepaid_product_codes') && $request->prepaid_product_codes != null) ? implode(',', $request->prepaid_product_codes) : null;
                $data['postpaid_product_codes'] = ($request->has('prepaid_product_codes') && $request->postpaid_product_codes != null) ? implode(',', $request->postpaid_product_codes) : null;
                $data['available_for_bl_users'] = isset($request->available_for_bl_users)? true : false;
                $premiumProduct = $this->save($data);
            });
            return true;

        } catch (\Exception $e) {
            Log::error('Toffee Premium Product store failed' . $e->getMessage());
            return false;
        }
    }

    public function updateToffeePremiumProduct($request, $id)
    {
        try {
            $toffeePremiumProduct = $this->findOne($id);
            DB::transaction(function () use ($request, $id, $toffeePremiumProduct) {    
                $data = [];
                $data['toffee_subscription_type_id'] = $request->toffee_subscription_type_id;
                $data['prepaid_product_codes'] = ($request->has('prepaid_product_codes') && $request->prepaid_product_codes != null) ? implode(',', $request->prepaid_product_codes) : null;
                $data['postpaid_product_codes'] = ($request->has('postpaid_product_codes') && $request->postpaid_product_codes != null) ? implode(',', $request->postpaid_product_codes) : null;
                $data['available_for_bl_users'] = isset($request->available_for_bl_users)? true : false;          
                $toffeePremiumProduct->update($data);
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Toffee Premium Product Update failed' . $e->getMessage());
            return false;
        }
    }


    public function deleteToffeePremiumProduct($id)
    {
        $toffeePremiumProduct = $this->findOne($id);
        $toffeePremiumProduct->delete();
        return Response('Toffee Premium Product has been successfully deleted');
    }

}
