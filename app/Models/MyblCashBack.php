<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblCashBack extends Model
{
    protected $fillable = ['title', 'start_date', 'end_date', 'status'];

    public function cashBackProducts(): HasMany
    {
        return $this->hasMany(MyblCashBackProduct::class);
    }
}
