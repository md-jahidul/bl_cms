<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerOffer extends Model
{
    protected $fillable = [
        'partner_id',
        'validity_en',
        'validity_bn',
        'offer_en',
        'offer_bn',
        'get_offer_msg_en',
        'get_offer_msg_bn',
        'btn_text_en',
        'btn_text_bn',
        'show_in_home',
        'is_active',
        'display_order',
        'other_attributes'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
