<?php
namespace App\Repositories;

use App\Models\ProductSpecialType;

class MyBlSpecialTypeRepository extends BaseRepository
{
    public $modelName = ProductSpecialType::class;

    // public function getGiftContent()
    // {
    //     return $this->model->orderBy('display_order','ASC')->get();
    // }

    public function productSpecialType()
    {
        return $this->model::orderBy('display_order', 'desc')->first();
    }

    public function productSpecialTypeTableSort($request)
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
