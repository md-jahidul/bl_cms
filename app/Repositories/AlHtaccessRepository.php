<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AlHtaccess;

class AlHtaccessRepository extends BaseRepository
{
    public $modelName = AlHtaccess::class;

    public function htaccessData()
    {
        return $this->model->first();
    }
}
