<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\CorpInitiativeTabComponent;

class CorpInitiativeTabComponentRepository extends BaseRepository
{
    public $modelName = CorpInitiativeTabComponent::class;

    public function list($tabId)
    {
        return $this->model->where('initiative_tab_id', $tabId)
            ->orderBy('component_order', 'ASC')
            ->get();
    }

    public function tabComponent($tabId)
    {
        return $this->model
            ->where('id', $tabId)
            ->with(['multiComponent', 'batchTabs' => function ($q) {
                $q->with('tabComponents');
            }])
            ->first();
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
} // Class end

