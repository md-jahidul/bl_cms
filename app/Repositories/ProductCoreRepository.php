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
                $coreData['name'] = $data['name_en'];
                $coreData['product_code'] = str_replace(' ', '', strtoupper($data['product_code']));
                $coreData['sim_type'] = $simId;
                $coreData['activation_ussd'] = $data['activation_ussd'] ?? null;
                $coreData['balance_check_ussd'] = $data['balance_check_ussd'] ?? null;
                $coreData['mrp_price'] = $data['price'] ?? null;
                $coreData['validity'] = $data['validity'] ?? null;
                $coreData['internet_volume_mb'] = $data['internet_volume_mb'] ?? null;
                $coreData['minute_volume'] = $data['minute_volume'] ?? null;
                $coreData['sms_volume'] = $data['sms_volume'] ?? null;
                $coreData['call_rate'] = $data['call_rate'] ?? null;
                $coreData['sms_rate'] = $data['sms_rate'] ?? null;
                $this->model->create($coreData);
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
