<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\MyblAppMenu;
use App\Models\Prize;

class MyblAppMenuRepository extends BaseRepository
{
    public $modelName = MyblAppMenu::class;

    public function allMenus($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)
            ->select('id', 'title_en', 'parent_id', 'component_identifier', 'icon', 'status', 'deep_link_slug')
            ->orderBy('display_order', 'asc')
            ->get();
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
