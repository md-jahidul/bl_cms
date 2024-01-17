<?php

namespace App\Repositories;

use App\Models\MyBlServiceItem;

class MyBlServiceItemRepository extends BaseRepository
{
    public $modelName = MyBlServiceItem::class;


    public function is_sequence_exist($sequence, $service_id)
    {
        $service_sequence =$this->model::where('my_bl_service_id', $service_id)
            ->where('sequence', $sequence)->get();
        return empty($service_sequence->all());
    }

    public function getServiceItems($service_id)
    {
        return $this->model->where('my_bl_service_id', $service_id)->orderBy('sequence','ASC')->get();
    }
    public function getLastServiceItems($service_id)
    {
        return $this->model->where('my_bl_service_id', $service_id)->orderBy('sequence','DESC')->first();
    }
    public function serviceItemTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
