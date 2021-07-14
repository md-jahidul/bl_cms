<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    public function referral()
    {
        return $this->hasOne(Referrer::class, 'id', 'referrer_id');
    }
}
