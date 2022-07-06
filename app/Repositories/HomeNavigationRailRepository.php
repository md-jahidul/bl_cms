<?php

namespace App\Repositories;

use App\Models\HomeNavigationRail;
use App\Models\Shortcut;

class HomeNavigationRailRepository extends BaseRepository
{
    public $modelName = HomeNavigationRail::class;


    /**
     * @return mixed
     */
    public function getNavigationRail()
    {
        return $this->model->orderBy('display_order', 'ASC')->get();
    }
}
