<?php

namespace App\Repositories;

use App\Models\ContentNavigationRail;

class ContentNavigationRailRepository extends BaseRepository
{
    public $modelName = ContentNavigationRail::class;

    public function getNavigationRail()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }
}
