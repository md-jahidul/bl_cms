<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AlReferralInfo extends Model
{
    use LogModelAction;
    
    protected $fillable = ['app_id', 'title_en', 'title_bn', 'details_en', 'details_bn','referral_image','btn_title_en','btn_title_bn','status'];
}
