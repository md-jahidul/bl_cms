<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Models\NonBlComponent;

class NonBlComponentRepository extends BaseRepository
{
    public $modelName = NonBlComponent::class;

    public function getChildMenus($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->orderBy('display_order')->get();
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
