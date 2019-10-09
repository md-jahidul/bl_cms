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

//        $items = request()->except(['_token','_method']);
//        foreach ($items as $key => $value){
//            $config = $this->model->where('key', $key)->first();
//            $config->value = $value;
//            if ($key == "site_logo"){
//                $config->value = $imageUrl;
////                $config->save();
//            }
//            $config->save();
//        }
    }
}
