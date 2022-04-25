<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CsSelfcareReferee extends Model
{
    use LogModelAction;
    
    protected $guarded = ['id'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Dhaka');
    }

    public function referrer()
    {
        return $this->belongsTo(CsSelfcareReferrer::class,'cs_selfcare_referrer_id');
    }
}
