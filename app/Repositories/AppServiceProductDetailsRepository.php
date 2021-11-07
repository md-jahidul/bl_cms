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

class AppServiceProductDetailsRepository extends BaseRepository
{
    public $modelName = AppServiceProductDetail::class;

    public function findSection($product_id)
    {
        return $this->model->with('sectionComponent')->where('product_id', $product_id)
            ->where('category', 'component_sections')
            ->whereNull('deleted_at')
            ->orderBy('section_order', 'asc')
            ->get();
    }

    public function fixedSection($product_id)
    {
        return $this->model->where('product_id', $product_id)
            ->where('category', 'app_banner_fixed_section')
            ->whereNull('deleted_at')
            ->first();
    }

    public function checkFixedSection($product_id)
    {
        return $this->model
            ->where('product_id', $product_id)
            ->where('category', 'app_banner_fixed_section')
            ->first();
    }


    public function sectionsTableSort($request){
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['section_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    public function findSectionEdit($section_id)
    {
        return $this->model->where('id', $section_id)
            ->with(['sectionComponent' => function ($q) {
                $q->with('componentMultiData');
            }])
            ->first();
    }

}
