<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingKey extends Model
{
    protected $table = 'setting_keys';
    protected $fillable = ['title'];
    public function settings()
    {
        return $this->hasOne('App\Models\Setting');
    }
}
