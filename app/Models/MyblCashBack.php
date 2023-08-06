<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblCashBack extends Model
{
    use LogModelAction;

    protected $fillable = ['title', 'start_date', 'end_date', 'status', 'user_type'];

    public function cashBackProducts(): HasMany
    {
        return $this->hasMany(MyblCashBackProduct::class);
    }
}
