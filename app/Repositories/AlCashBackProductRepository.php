<?php

namespace App\Repositories;

use App\Models\AlCashBackProduct;

class AlCashBackProductRepository extends BaseRepository
{
    public $modelName = AlCashBackProduct::class;

    public function deleteCampaignWiseProduct($id)
    {
        return $this->model->whereIn('all_cash_back_id', [$id])->delete();
    }
}
