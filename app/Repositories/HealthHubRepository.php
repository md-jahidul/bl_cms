<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\MyblHealthHub;

class HealthHubRepository extends BaseRepository
{
    public $modelName = MyblHealthHub::class;

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

    public function categories()
    {
        return $this->model
            ->withCount('manageItems')
            ->with(['manageItems' => function ($q) {
                $q->select('manage_categories_id', 'component_identifier');
            }])
            ->orderBy('display_order', 'ASC')
            ->get();
    }
}
