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

    /**
     * @param $productCode
     * @return string
     */
    public function getProductType($productCode): string
    {
        $product = $this->model->where('product_code', $productCode)->select('sim_type')->first();
        $productType = "other";
        if ($product->sim_type == 1) {
            $productType = "prepaid";
        } elseif ($product->sim_type == 2) {
            $productType = "postpaid";
        }
        return $productType;
    }

    public function findScheduleProductList()
    {
        return $this->model::where('is_commercial_name_en_schedule', 1)->orWhere('is_commercial_name_bn_schedule', 1)->orWhere('is_display_title_en_schedule', 1)->orWhere('is_display_title_bn_schedule', 1)->get();
    }

    public function updateDataById($id, $data)
    {
        return $this->model::where('id', $id)->update($data);
    }
}
