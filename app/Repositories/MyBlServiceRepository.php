<?php

namespace App\Repositories;

use App\Models\MyBlService;

class MyBlServiceRepository extends BaseRepository
{
    public $modelName = MyBlService::class;

    public function getServices()
    {
        return $this->modelName::orderBy('sequence','ASC')->get();
    }

    public function serviceSequence()
    {
        return $this->model::orderBy('sequence', 'desc')->first();
    }

}
