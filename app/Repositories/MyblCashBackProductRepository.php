<?php

namespace App\Repositories;

use App\Models\MyblCashBackProduct;

class MyblCashBackProductRepository extends BaseRepository
{
    public $modelName = MyblCashBackProduct::class;

    public function deleteCampaignWiseProduct($id)
    {
        return $this->model->whereIn('mybl_cash_back_id', [$id])->delete();
    }
}
