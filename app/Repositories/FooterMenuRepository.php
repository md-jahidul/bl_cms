<?php


namespace App\Repositories;

use App\Models\FooterMenu;

class FooterMenuRepository extends BaseRepository
{
    public $modelName = FooterMenu::class;

    public function getChildMenus($parent_id)
    {
        return $this->model->where('parent_id', $parent_id)->orderBy('display_order')->with('children')->get();
    }

    public function footerTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $footer_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($footer_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
