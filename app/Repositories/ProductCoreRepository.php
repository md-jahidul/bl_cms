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

    public function insertProductCore($data, $simId)
    {
        if (isset($data)) {
            $productCode = $this->model->where('product_code', $data)->first();

            if (empty($productCode)) {
                $data['name'] = $data['name_en'];
                $data['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
                $data['mrp_price'] = $data['price'] + $data['vat'];
                $data['sim_type'] = $simId;
                $this->model->create($data);
            }
        }
    }

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
