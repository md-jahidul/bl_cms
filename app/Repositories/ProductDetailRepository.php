<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\ProductDetail;


class ProductDetailRepository extends BaseRepository
{
    public $modelName = ProductDetail::class;

    public function saveOrUpdateProductDetail($productId)
    {
        $this->model->updateOrCreate(
            [ 'product_id' => $productId]
        );
    }

    public function saveProductDetails($data, $productId)
    {
        $this->model->where('product_id', $productId)->update($data);
    }

}
