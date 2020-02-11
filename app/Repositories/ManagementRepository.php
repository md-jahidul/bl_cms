<?php

namespace App\Repositories;

use App\Models\AboutUsManagement;

class ManagementRepository extends BaseRepository
{
    public $modelName = AboutUsManagement::class;

    /**
     * @return mixed
     */
    public function getManagementInfo()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }

    /**
     * @param $request
     * @return string
     */
    public function sortManangementInfo($request)
    {
        $positions = $request->position;

        foreach ($positions as $position) {
            if ($position[0] == null) {
                continue;
            }

            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);

            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }

        return "success";
    }
}
