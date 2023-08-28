<?php

namespace App\Services;

use App\Repositories\ToffeeSubscriptionTypeRepository;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ToffeeSubscriptionTypeService
{
    use CrudTrait;
    use FileTrait;

    protected $toffeeSubscriptionTypeRepository;

    public function __construct(ToffeeSubscriptionTypeRepository $toffeeSubscriptionTypeRepository)
    {
        $this->toffeeSubscriptionTypeRepository = $toffeeSubscriptionTypeRepository;
        $this->setActionRepository($toffeeSubscriptionTypeRepository);
    }

    public function getToffeeSubscriptionTypes()
    {
        return $this->toffeeSubscriptionTypeRepository->findAll();
    }

    public function storeToffeeSubscriptionType($subscriptionType)
    {
        try {
            DB::transaction(function () use ($subscriptionType) {
                $subscriptionType = $this->save($subscriptionType);
            });
            return true;

        } catch (\Exception $e) {
            Log::error('Toffee Subscription Type store failed' . $e->getMessage());
            return false;
        }
    }

    public function updateToffeeSubscriptionType($data, $id)
    {
        try {
            $productSpecialType = $this->findOne($id);
            DB::transaction(function () use ($data, $id, $productSpecialType) {              
                $productSpecialType->update($data);
            });
            return true;
        } catch (\Exception $e) {
            Log::error('Toffee Subscription Type store failed' . $e->getMessage());
            return false;
        }
    }


    public function deleteToffeeSubscriptionType($id)
    {
        $productSpecialType = $this->findOne($id);
        $productSpecialType->delete();
        return Response('Toffee Subscription Type has been successfully deleted');
    }

}
