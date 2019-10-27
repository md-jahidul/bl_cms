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
}
