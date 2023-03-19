<?php

namespace App\Repositories;

use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Models\PaymentGateway;
use App\Repositories\BaseRepository;


class PaymentGatewayRepository extends BaseRepository
{

    public $modelName = PaymentGateway::class;

    public function destroy($id)
    {
        return PaymentGateway::where('id',$id)->delete();
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
}
