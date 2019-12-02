<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Priyojon;

class PriyojonRepository extends BaseRepository
{
    public $modelName = Priyojon::class;

    public function getChildPriyojons($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->get();
    }

    public function menuTableSort($request)
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
