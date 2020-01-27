<?php

namespace App\Repositories;

use App\Models\Config;

class ConfigRepository extends BaseRepository
{
    public $modelName = Config::class;

    public function updateConfig($key)
    {
        $config = $this->model->where('key', $key)->first();
        return $config;
    }
}
