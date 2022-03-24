<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use LogModelAction;
    
    public function referral()
    {
        return $this->hasOne(Referrer::class, 'id', 'referrer_id');
    }
}
