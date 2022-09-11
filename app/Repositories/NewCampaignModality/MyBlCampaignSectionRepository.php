<?php

namespace App\Repositories\NewCampaignModality;

use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Repositories\BaseRepository;


class MyBlCampaignSectionRepository extends BaseRepository
{

    public $modelName = MyBlCampaignSection::class;

    public function destroy($id)
    {
        return MyBlCampaignSection::where('id',$id)->delete();
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
