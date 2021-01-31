<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\CorpIntBatchComponentTab;
use App\Models\Prize;

class CorpIntBatchComTabRepository extends BaseRepository
{
    public $modelName = CorpIntBatchComponentTab::class;

    public function findDetail($key)
    {
        return $this->model->where('slug', $key)->first();
    }
}
