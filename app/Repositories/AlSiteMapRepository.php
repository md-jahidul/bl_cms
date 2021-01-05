<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AlSiteMap;

class AlSiteMapRepository extends BaseRepository
{
    public $modelName = AlSiteMap::class;

    public function deleteTagType($type)
    {
        return $this->model->whereIn('tag_type', [$type])->delete();
    }
}
