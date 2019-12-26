<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerOffer extends Model
{
    protected $fillable = [
        'partner_id',
        'product_code',
        'validity_en',
        'validity_bn',
        'start_date',
        'end_date',
        'offer_scale',
        'offer_value',
        'offer_unit',
        'get_offer_msg_en',
        'get_offer_msg_bn',
        'btn_text_en',
        'btn_text_bn',
        'campaign_img',
        'is_campaign',
        'show_in_home',
        'is_active',
        'display_order',
        'other_attributes'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function partner_offer_details()
    {
        return $this->hasOne(PartnerOfferDetail::class);
    }

}
