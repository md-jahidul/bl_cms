<?php

namespace App\Repositories;

use App\Models\MetaTag;
use App\Models\QuickLaunchItem;

class MetaTagRepository extends BaseRepository
{
    public $modelName = MetaTag::class;

    public function metaTag($id)
    {
        return $this->model->where('page_id', $id)->first();
    }

    public function createOrUpdate($data, $key)
    {
        return $this->model->updateOrCreate(['dynamic_route_key' => $key], $data);
    }
}
