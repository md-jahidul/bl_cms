<?php

namespace App\Repositories;

use App\Models\MyBlPlanProduct;

class MyBlPlanProductRepository extends BaseRepository
{
    public $modelName = MyBlPlanProduct::class;

    public function updateOrCreateProduct($core_product)
    {
        return $this->model->updateOrCreate(['product_code' => $core_product['product_code']] , $core_product);
    }
}
