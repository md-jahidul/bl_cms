<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:51 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\ComponentMultiData;
use App\Models\Prize;

class ComponentMultiDataRepository extends BaseRepository
{
    public $modelName = ComponentMultiData::class;

    public function findDataOne($imgName)
    {
        return $this->model->where('img_name_en', $imgName)
            ->orWhere('img_name_bn', $imgName)
            ->first();
    }

    public function deleteAllById($id)
    {
        return $this->model->whereIn('component_id', [$id])->delete();
    }
}
