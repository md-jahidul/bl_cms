<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSlider;
use App\Models\AppServiceCategory;
use App\Models\AppServiceProduct;
use App\Models\AppServiceProductDetail;

class AppServiceProductDetailsRepository extends BaseRepository
{
    public $modelName = AppServiceProductDetail::class;

    public function findSection($product_id)
    {
        return $this->model->where('product_id', $product_id)
            ->whereNotNull('section_name')
            ->get();
    }

    public function fixedSection($product_id)
    {
        return $this->model->where('product_id', $product_id)
            ->whereNull('section_name')
            ->first();
    }

    public function checkFixedSection($product_id)
    {
        return $this->model
            ->where('product_id', $product_id)
            ->whereNotNull('category')
            ->first();
    }
}
