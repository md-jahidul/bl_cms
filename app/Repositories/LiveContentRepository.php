<?php
namespace App\Repositories;

use App\Models\LiveContent;

class LiveContentRepository extends BaseRepository
{
    public $modelName = LiveContent::class;

    public function getCarouselImage()
    {
        return $this->model->orderBy('display_order','ASC')->get();
    }

    public function carouselImage()
    {
        return $this->model::orderBy('display_order', 'desc')->first();
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
        return true;
    }
}
