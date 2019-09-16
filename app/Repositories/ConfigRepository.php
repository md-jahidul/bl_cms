<?php


namespace App\Repositories;


use App\Models\Config;

class ConfigRepository extends BaseRepository
{
    public $modelName = Config::class;

    public function updateConfig($request)
    {
        $items = $request->except(['_token','_method']);
        foreach ($items as $key => $value){
            $config = $this->model->where('key', $key)->first();
            $config->value = $value;
            $config->save();
        }
    }
}
