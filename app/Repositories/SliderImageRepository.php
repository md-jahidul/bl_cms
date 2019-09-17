<?php
/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 12:19 PM
 */

namespace App\Repositories;


use App\Models\SliderImage;

class SliderImageRepository extends BaseRepository
{
    public $modelName = SliderImage::class;

    public function getSliderImage($sliderId, $type)
    {
        return $this->model->where('slider_id', $sliderId)->orderBy('sequence')->get();
    }

    public function sliderImageTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position){
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
