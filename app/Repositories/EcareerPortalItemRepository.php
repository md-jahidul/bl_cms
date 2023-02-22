<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\EcareerPortalItem;
use Carbon\Carbon;

class EcareerPortalItemRepository extends BaseRepository
{
    public $modelName = EcareerPortalItem::class;


    /**
     * [getItemsByParentID description]
     * @param  [type] $parent_id [description]
     * @return [type]            [description]
     */
    public function getItemsByParentID($parent_id){

    	return $this->model::where('ecarrer_portals_id', '=', $parent_id)->whereNull('deleted_at')->orderBy('display_order')->get();

    }

    /**
     * [getSingleItemByID description]
     * @param  [type] $parent_id [description]
     * @param  [type] $id        [description]
     * @return [type]            [description]
     */
    public function getSingleItemByID($parent_id, $id){

    	return $this->model::where('id', $id)->where('ecarrer_portals_id', '=', $parent_id)->whereNull('deleted_at')->first();

    }

    /**
     * [sectionItemSoftDeleteBySectionID description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function sectionItemSoftDeleteBySectionID($id){

        return $this->model::where('ecarrer_portals_id', $id)->update(['deleted_at' => Carbon::now()]);

    }


    /**
     * Ecarrer item sortable
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function ecarrerItemTableSort($request){

        $positions = $request->position;
        foreach ($positions as $position) {
            $menu_id = $position[0];
            $new_position = $position[1];
            $update_menu = $this->model->findOrFail($menu_id);
            $update_menu['display_order'] = $new_position;
            $update_menu->update();
        }
        return "success";

    }

    public function findProgramList($programId){
        return $this->model::where('ecarrer_portals_id', '=', $programId)->whereNull('deleted_at')->orderBy('display_order')->get();
    }
}
