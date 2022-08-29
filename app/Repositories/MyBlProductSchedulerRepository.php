<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 1:14 PM
 */

namespace App\Repositories;


use App\Models\MyBlProductScheduler;

class MyBlProductSchedulerRepository extends BaseRepository
{
    public $modelName = MyBlProductScheduler::class;

    public function findScheduleDataByProductCode($product_code)
    {
        return $this->model::where('product_code', $product_code)->first();
    }

    public function updateByProductCode($productSchedule) {
        $data = $this->model::where('product_code', $productSchedule['product_code'])->first();
        $data->update($productSchedule);
    }
}
