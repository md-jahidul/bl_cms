<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\AlSliderImage;
use App\Models\PartnerOffer;

class PartnerOfferRepository extends BaseRepository
{
    public $modelName = PartnerOffer::class;

    public function getPartnerOffer($partnerId, $isHome)
    {
        $query =  $this->model;
        $query = ($isHome) ? $query->where('show_in_home', 1)->orderBy('display_order')  : $query->where('partner_id', $partnerId)->orderBy('created_at');
        return $query->with('partner')->get();
    }

    public function campaigin()
    {
        return $this->model->where('is_campaign', 1)->orderBy('campaign_order')->get();
    }

    public function sortable($request, $orderColumn = 'display_order')
    {
        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu[$orderColumn] = $new_position;
            $update_menu->update();
        }
        return "success";
    }
}
