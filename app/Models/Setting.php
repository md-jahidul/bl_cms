<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['setting_key_id','limit'];
    
    public function settingsKey()
    {
        return $this->hasOne('App\Models\SettingKey','id','setting_key_id');
    }
}
