<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:07
 */

namespace App\Repositories;

use App\Models\BaseMsisdnGroup;

class BaseMsisdnGroupRepository extends BaseRepository
{
    public $modelName = BaseMsisdnGroup::class;

    public  function getMsisdnGroupTitle($id)
    {
        $data = $this->model->where('id', $id)->select('title')->first();

        return $data->title;
    }
}
