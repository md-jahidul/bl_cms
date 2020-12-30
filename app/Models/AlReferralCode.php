<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlReferralCode extends Model
{
    public function apps()
    {
        return $this->hasOne(AppServiceProduct::class, 'id', 'app_id');
    }
}
