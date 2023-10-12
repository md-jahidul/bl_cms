<?php

namespace App\Repositories\Page;

use App\Models\Page\NewPageComponentData;
use App\Repositories\BaseRepository;

class PgComponentDataRepository extends BaseRepository
{
    public $modelName = NewPageComponentData::class;

    public function deleteComponentData($id)
    {
        $this->model->whereIn('component_id', [$id])->delete();
    }
}
