<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:34 PM
 */

namespace App\Repositories;

use App\Models\OfferCategory;

class OfferCategoryRepository extends BaseRepository
{
    public $modelName = OfferCategory::class;

    /**
     * @param $type
     * @return mixed
     */
    public function getList($type)
    {
        return $this->model->packageType($type)->get();
    }

    public function childPackage()
    {
        return $this->model->where('parent_id', 4)->get();
    }
}
