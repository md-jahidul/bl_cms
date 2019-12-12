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

    /**
     * @param $id
     * @return mixed
     */
    public function findWithProduct($id)
    {
        return $this->model->where('product_code', $id)->with(['product', 'offer_category' => function ($query) {
            $query->select('id', 'name_en');
        }])->first();
    }

    public function findOneProductCore($id)
    {
        return $this->model->where('product_code', $id)->first();
    }
}
