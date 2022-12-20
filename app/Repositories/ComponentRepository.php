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

    /**
     * Component multiple attribute sort
     * @param  [type] $request [description]
     * @return bool [type] [description]
     */
    public function multiAttrTableSort($request)
    {
        $component_id = $request->component_id;
        $component = $this->model->findOrFail($component_id);
        if (!empty($component->multiple_attributes)) {
            $multi_attr = json_decode($component->multiple_attributes, true);
            $new_multiattr = null;
            $positions = $request->position;
            // dd($positions);
            $final_results = [];
            foreach ($multi_attr as $value) {
                $sub_data = [];
                foreach ($positions as $position) {
                    $menu_id = $position[0]; // slider id / id
                    $new_order = $position[1]; // order position
                    if ($menu_id == $value['id']) {
                        $value['display_order'] = $new_order;
                    }
                    $sub_data = $value;
                }
                $final_results[] = $sub_data;
            }
        }

        if (!empty($final_results) && count($final_results) > 0) {
            $component->multiple_attributes = json_encode($final_results);
            $component->update();
            return true;
        } else {
            return false;
        }
    }

    public function list($section_id, $pageType)
    {
        return $this->model->where('section_details_id', $section_id)
            ->where('page_type', $pageType)
            ->orderBy('component_order', 'ASC')
            ->get();
    }

    public function componentTableSort($request)
    {
        $positions = $request['position'];
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['component_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
} // Class end

