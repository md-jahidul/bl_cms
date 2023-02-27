<?php

namespace App\Repositories;
use App\Models\TravelAgency;
use App\Models\UtilityBill;


class TravelAgencyRepository extends BaseRepository
{

    public $modelName = TravelAgency::class;

    public function destroy($id)
    {
        return TravelAgency::where('id',$id)->delete();
    }
    public function manageTableSort($request)
    {
        $positions = $request->position;

        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
