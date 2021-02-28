<?php

namespace App\Repositories;

use App\Models\MyBlProductTag;

class MyBlProductTagRepository extends BaseRepository
{
    public $modelName = MyBlProductTag::class;

    public function deleteByProductCode($productCode)
    {
        return $this->model->where('product_code', $productCode)->delete();
    }
}
