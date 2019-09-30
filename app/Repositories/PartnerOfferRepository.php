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

    public function getPartnerOffer($partnerId)
    {
        return $this->model->where('partner_id', $partnerId)->orderBy('display_order')->with('partner')->get();
    }

    public function partnerOfferTableSort($request)
    {
        $positions = $request->position;
        foreach ($positions as $position){
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";
    }

}
