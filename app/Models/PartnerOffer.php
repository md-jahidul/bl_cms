<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PartnerOffer extends Model
{
    use LogModelAction;

    protected $fillable = [
        'partner_id',
        'partner_category_id',
        'loyalty_tier_id',
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
        'silver',
        'gold',
        'platium',
        'area_id',
        'phone',
        'location',
        'map_link',
        'campaign_img',
        'image_name_en',
        'image_name_bn',
        'is_campaign',
        'show_in_home',
        'is_active',
        'url_slug',
        'url_slug_bn',
        'page_header',
        'page_header_bn',
        'schema_markup',
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

    protected $casts = [
        'other_attributes' => 'array'
    ];
}
