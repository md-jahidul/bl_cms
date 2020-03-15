<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSlider;
use App\Models\AppServiceCategory;
use App\Models\AppServiceProduct;
use App\Models\AppServiceProductDetail;
use App\Models\Component;

class ComponentRepository extends BaseRepository
{
    public $modelName = Component::class;

    public function list($section_id, $pageType)
    {
        return $this->model->where('section_details_id', $section_id)
            ->where('page_type', $pageType)
            ->orderBy('component_order', 'ASC')
            ->get();
    }

    public function componentTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['component_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
