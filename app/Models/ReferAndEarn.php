<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ReferAndEarn extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function referrers()
    {
        return $this->hasMany(Referrer::class);
    }
}
