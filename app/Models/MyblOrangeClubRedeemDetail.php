<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblOrangeClubRedeemDetail extends Model
{
    protected $fillable = [
        'redeem_title_en',
        'redeem_title_bn',
        'redeem_logo',
        'coin_amount',
        'btn_text_en',
        'btn_text_bn'
    ];
}
