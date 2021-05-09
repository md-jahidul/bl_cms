<?php

/**
 * Created by PhpStorm.
 * User: Jahid
 * Date: 29-March-11
 * Time: 12:51 PM
 */

namespace App\Repositories;

use App\Models\ProductActivity;
use Illuminate\Support\Facades\Auth;

class ProductActivityRepository extends BaseRepository
{
    public $modelName = ProductActivity::class;

    public function storeProductActivity($data, $others, $model = null)
    {
        if (isset($model)) {
            $oldData = [];
            foreach ($data as $key => $inputData) {
                $oldData[$key] = $model[$key];
            }
            $productActivity['updated_data']['old'] = $oldData;
        }

        $productActivity['user_id'] = Auth::id();
        $productActivity['product_code'] = $data['product_code'];
        $productActivity['activity_type'] = $others['activity_type'];
        $productActivity['platform'] = $others['platform'];
        $productActivity['updated_data']['new'] = $data;
        $this->model->create($productActivity);
    }
}
