<?php

namespace App\Repositories;

use App\Models\NonBlNavigationRail;

class NonBlNavigationRailRepository extends BaseRepository
{
    public $modelName = NonBlNavigationRail::class;

    public function getNavigationRail()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }
}
