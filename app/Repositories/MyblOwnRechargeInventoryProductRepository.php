<?php

namespace App\Repositories;

use App\Models\MyBlOwnRechargeInvertoryProduct;

class MyblOwnRechargeInventoryProductRepository extends BaseRepository
{
    public $modelName = MyBlOwnRechargeInvertoryProduct::class;

    public function deleteCampaignWiseProduct($id)
    {
        return $this->model->whereIn('own_recharge_id', [$id])->delete();
    }
}
