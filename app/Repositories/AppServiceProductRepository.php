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

class AppServiceProductRepository extends BaseRepository
{
    public $modelName = AppServiceProduct::class;


    public function appServiceProduct($tab_type, $product_id)
    {
        return $this->model
            ->where('id', '!=', $product_id)
            ->productTabType($tab_type)
            ->select('id', 'app_service_tab_id', 'name_en')
            ->get();
    }
}
