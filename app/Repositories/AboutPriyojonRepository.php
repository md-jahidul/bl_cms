<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPriyojon;
use App\Models\Prize;

class AboutPriyojonRepository extends BaseRepository
{
    public $modelName = AboutPriyojon::class;

    public function findDetail($key)
    {
        return $this->model->where('slug', $key)->first();
    }
}
