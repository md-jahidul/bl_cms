<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 1:14 PM
 */

namespace App\Repositories;


use App\Models\MyBlProductScheduler;
use Carbon\Carbon;

class MyBlProductSchedulerRepository extends BaseRepository
{
    public $modelName = MyBlProductScheduler::class;

    public function findScheduleDataByProductCode($product_code)
    {
        return $this->model::where('product_code', $product_code)->first();
    }

    public function updateByProductCode($productSchedule) {
        $data = $this->model::where('product_code', $productSchedule['product_code'])->first();
        if(is_null($data)) {
            return $this->model::create($productSchedule);
        } else {

            return $data->update($productSchedule);
        }
    }

    public function updateDataById($id, $data)
    {

        return $this->model::where('id', $id)->update($data);
    }

    public function getAllScheduleProducts() {
        $currentTime = Carbon::parse()->format('Y-m-d H:i:s');

        return $this->model::where('start_date', '<=' ,$currentTime)->where('end_date', '>=' ,$currentTime)->orWhere('change_state_status', 1)->orWhere('start_date', '>' ,$currentTime)->get();
    }
}
