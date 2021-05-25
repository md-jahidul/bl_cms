<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferAndEarn extends Model
{
    protected $guarded = ['id'];

    public function referrers()
    {
        return $this->hasMany(Referrer::class);
    }
}
