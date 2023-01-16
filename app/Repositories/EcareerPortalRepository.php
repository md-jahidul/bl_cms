<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\EcareerPortal;

class EcareerPortalRepository extends BaseRepository
{
    public $modelName = EcareerPortal::class;


    /**
     * [getSectionsByCategory description]
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public function getSectionsByCategory($category){
    		return $this->model::with('portalItems')
            ->where('category', '=', $category)
            ->whereNull('deleted_at')
            ->orderBy('display_order','asc')->get();
    }



    /**
     * [getSectionSlugByID description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSectionSlugByID($id){
        return $this->model::where('id', $id)->whereNull('deleted_at')->first()->category;
    }


    public function getParentRouteSlugByID($id){
    	return $this->model::where('id', $id)->whereNull('deleted_at')->first()->route_slug;
    }

    public function getSectionDataByID($id){
        return $this->model::where('id', $id)->whereNull('deleted_at')->first();
    }

    //update category and sub category
    public function updateMainSection($data, $id){
        return $this->model::where('id', $id)->update($data);
    }

    public function findProgramId(){
        return $this->model::where('is_program',1)->first();
    }


}
