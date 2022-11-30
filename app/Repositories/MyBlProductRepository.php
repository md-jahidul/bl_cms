<?php

namespace App\Repositories;

use App\Models\MyBlProduct;

class MyBlProductRepository extends BaseRepository
{
    public $modelName = MyBlProduct::class;

    public function updateDataById($id, $data)
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function findScheduleProductList()
    {
        return $this->model::where('is_banner_schedule', 1)->orWhere('is_tags_schedule', 1)->orWhere('is_visible_schedule', 1)->orWhere('is_pin_to_top_schedule', 1)->orWhere('is_base_msisdn_group_id_schedule', 1)->get();
    }
}
