<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblManageCategory;

class MyblManageRepository extends BaseRepository
{
    public $modelName = MyblManageCategory::class;

    public function allMenus($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)
            ->select('id', 'title_en', 'parent_id', 'icon', 'status')
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
