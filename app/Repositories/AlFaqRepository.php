<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlFaq;
use App\Models\Role;

class AlFaqRepository extends BaseRepository
{
    public $modelName = AlFaq::class;

    public function faqTableSort($request)
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
