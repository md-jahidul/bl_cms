<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCore;
use App\Models\SimCategory;

class ProductCoreRepository extends BaseRepository
{
    public $modelName = ProductCore::class;

    public function insertProductCore($data)
    {
        if (isset($data)) {
            $productCode = $this->model->where('product_code', $data)->first();

            if (empty($productCode)) {
                $this->model->create([
                    'product_code' => str_replace(' ', '', strtoupper($data))
                ]);
            }
        }
    }
}
