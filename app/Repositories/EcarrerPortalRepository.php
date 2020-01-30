<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\EcarrerPortal;

class EcarrerPortalRepository extends BaseRepository
{
    public $modelName = EcarrerPortal::class;


    /**
     * [getSectionsByCategory description]
     * @param  [type] $category [description]
     * @return [type]           [description]
     */
    public function getSectionsByCategory($category){
    		return $this->model::with('portalItems')->where('category', '=', $category)->get();
    }
}
