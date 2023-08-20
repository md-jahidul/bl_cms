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

    public function storeToffeePremiumProduct($premiumProduct)
    {
        try {
            DB::transaction(function () use ($premiumProduct) {
                $data['toffee_subscription_type_id'] = $premiumProduct['toffee_subscription_type_id'];
                $data['prepaid_product_codes'] = implode(', ', $premiumProduct['prepaid_product_codes']);
                $data['postpaid_product_codes'] = implode(', ', $premiumProduct['postpaid_product_codes']);
                $data['available_for_bl_users'] = isset($premiumProduct['available_for_bl_users'])? true : false;
                $premiumProduct = $this->save($data);
            });
            return true;

        } catch (\Exception $e) {
            Log::error('Toffee Premium Product store failed' . $e->getMessage());
            return false;
        }
    }

    public function updateToffeePremiumProduct($data, $id)
    {
        try {
            $productSpecialType = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $productSpecialType) {              
                $productSpecialType->update($data);
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Toffee Premium Product store failed' . $e->getMessage());
            return false;
        }
    }


    public function deleteToffeePremiumProduct($id)
    {
        $productSpecialType = $this->findOne($id);
        $productSpecialType->delete();
        return Response('Toffee Premium Product has been successfully deleted');
    }

}
