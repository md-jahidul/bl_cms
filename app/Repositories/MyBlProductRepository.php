<?php

namespace App\Repositories;

use App\Models\MyBlProduct;
use Illuminate\Support\Facades\Redis;

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

    public function productSortable($request)
    {
        try {
            $positions = $request->position;
            $item1 = $this->model::where('id', $positions[0][0])->first();
            $item2 = $this->model::where('id', $positions[1][0])->first();

            $data1['pin_to_top_sequence'] = $item2->pin_to_top_sequence;
            $data2['pin_to_top_sequence'] = $item1->pin_to_top_sequence;


            $this->model::where('id', $positions[0][0])->update($data1);
            $this->model::where('id', $positions[1][0])->update($data2);


            return [
                'status' => "success",
                'massage' => "Order Changed successfully"
            ];
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            return [
                'status' => "error",
                'massage' => $error
            ];
        }
    }
}
