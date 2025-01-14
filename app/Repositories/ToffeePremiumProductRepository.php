<?php
namespace App\Repositories;

use App\Models\ToffeePremiumProduct;

class ToffeePremiumProductRepository extends BaseRepository
{
    public $modelName = ToffeePremiumProduct::class;

    public function toffeePremiumProduct()
    {
        return $this->model::orderBy('created_at', 'desc')->first();
    }

}
