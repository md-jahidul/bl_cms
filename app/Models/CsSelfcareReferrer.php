<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CsSelfcareReferrer extends Model
{
    protected $guarded = ['id'];

    public function referees()
    {
        return $this->hasMany(CsSelfcareReferee::class,'cs_selfcare_referrer_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Dhaka')->toDateTimeString();
    }
}
