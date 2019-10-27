<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSliderImage;

class AlSliderImageRepository extends BaseRepository
{
    public $modelName = AlSliderImage::class;

    public function getSliderImage($sliderId, $type)
    {
        return $this->model->where('slider_id', $sliderId)->orderBy('display_order')->get();
    }

    public function sliderImageTableSort($request)
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
