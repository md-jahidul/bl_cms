<?php

namespace App\Repositories;

use App\Models\CommerceNavigationRail;
use App\Models\ContentNavigationRail;

class CommerceNavigationRailRepository extends BaseRepository
{
    public $modelName = CommerceNavigationRail::class;

    public function getNavigationRail()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }
}
