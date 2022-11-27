<?php

/**
 * Created by PhpStorm.
 * User: shohag
 * Date: 03/01/21
 * Time: 22:07
 */

namespace App\Repositories;

use App\Models\PopupBanner;
use Carbon\Carbon;

class PopupBannerRepository extends BaseRepository
{
    public $modelName = PopupBanner::class;

    /**
     * @param null $from
     * @param null $to
     * @param null $purchaseId
     * @return mixed
     */
    public function getPopupBanner($from = null, $to = null, $purchaseId = null)
    {
        return "A";
    }

    public function manageTableSort($request)
    {
        $positions = $request->position;
//        dd($request->all());
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

    public function priorityUpdate($request)
    {
        PopupBanner::query()->update(['is_priority' => $request->is_priority ?? 0]);
    }



}
