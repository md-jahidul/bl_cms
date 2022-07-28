<?php
namespace App\Repositories;

use DB;
use App\Models\SliderImage;

class SliderImageRepository extends BaseRepository
{
    public $modelName = SliderImage::class;

    public function getSliderImage($sliderId)
    {
        return $this->model->where('slider_id', $sliderId)->orderBy('sequence','ASC')->get();
    }

    public function is_sequence_exist($sequence, $slider_id)
    {
        $image_sequence = DB::table('slider_images')
                    ->where('slider_id', $slider_id)
                    ->where('sequence', $sequence)->get();
        return empty($image_sequence->all());
    }

    public function sliderImage($slider_id)
    {
        return DB::table('slider_images')->where('slider_id', $slider_id)->orderBy('sequence', 'desc')->first();
    }

    public function sliderImageTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['sequence'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
