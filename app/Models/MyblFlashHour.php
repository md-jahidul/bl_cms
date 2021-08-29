<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblFlashHour extends Model
{
    protected $fillable = ['title', 'base_msisdn_groups_id', 'start_date', 'end_date', 'status'];

    public function flashHourProducts(): HasMany
    {
        return $this->hasMany(MyblFlashHourProduct::class, 'flash_hour_id', 'id');
    }
}
