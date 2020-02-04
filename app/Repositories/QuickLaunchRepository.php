<?php

namespace App\Repositories;

use App\Models\QuickLaunchItem;

class QuickLaunchRepository extends BaseRepository
{
    public $modelName = QuickLaunchItem::class;

    public function getQuickLaunch($type)
    {
        return $this->model->where('type', $type)->orderBy('display_order', 'ASC')->get();
    }

    public function quickLaunchTableSort($request)
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
