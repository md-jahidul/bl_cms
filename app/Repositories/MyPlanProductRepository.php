<?php

namespace App\Repositories;

use App\Models\MyPlanProduct;

class MyPlanProductRepository extends BaseRepository
{
    public $modelName = MyPlanProduct::class;

    public function updateOrCreateProduct($core_product)
    {
        return $this->model->updateOrCreate(['product_code' => $core_product['product_code']] , $core_product);
    }
}
