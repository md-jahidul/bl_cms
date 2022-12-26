<?php

namespace App\Repositories;

use App\Models\ExploreC;
// use App\Repositories\BaseRepository;


class ExploreCRepository extends BaseRepository
{
    protected $modelName = ExploreC::class;

    public function exploreCTableSort($request)
    {
        // return $request['position'];
        $positions = $request['position'];
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
