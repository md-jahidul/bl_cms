<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlReferralCode extends Model
{
    use LogModelAction;
    
    public function apps()
    {
        return $this->hasOne(AppServiceProduct::class, 'id', 'app_id');
    }
}
