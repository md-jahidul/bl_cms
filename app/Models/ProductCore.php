<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ProductCore extends Model
{
    use LogModelAction;

    protected $fillable = [
        'product_code',
        'renew_product_code',
        'recharge_product_code',
        'name',
        'commercial_name_en',
        'commercial_name_bn',
        'short_description',
        'sim_type',
        'content_type',
        'family_name',
        'activation_ussd',
        'balance_check_ussd',
        'mrp_price',
        'price',
        'vat',
        'validity',
        'validity_unit',
        'internet_volume_mb',
        'data_volume',
        'data_volume_unit',
        'sms_volume',
        'minute_volume',
        'call_rate',
        'call_rate_unit',
        'sms_rate',
        'sms_rate_unit',
        'is_bundle',
        'is_auto_renewable',
        'is_recharge_offer',
        'is_gift_offer',
        'show_in_app',
        'offer_id',
        'is_social_pack',
        'other_info',
        'status',
        'validity_in_days',
        'platform',
        'display_sd_vat_tax',
        'display_title_en',
        'display_title_bn',
        'points',
        'is_commercial_name_en_schedule',
        'is_commercial_name_bn_schedule',
        'is_display_title_en_schedule',
        'is_display_title_bn_schedule',
        'service_image_url',
        'name_bn',
        'show_timer',
        'activation_type',
        'cta_name_en',
        'cta_name_bn',
        'cta_bgd_color',
        'cta_text_color',
        'redirection_name_en',
        'redirection_name_bn',
        'redirection_deeplink',
        'lms_tier_slab',
    ];

    protected $guarded = ['id'];


    public function product()
    {
        return $this->hasOne(Product::class, 'product_code', 'product_code');
    }

    public function blProduct()
    {
        return $this->hasOne(MyBlProduct::class, 'product_code', 'product_code');
    }

    public function sim_category()
    {
        return $this->belongsTo(SimCategory::class, 'product_sim_package', 'id');
    }

    public function offer_category()
    {
        return $this->belongsTo(OfferCategory::class, 'product_sim_package', 'id');
    }

    public function scopeCategory($query, $type)
    {
        return $query->whereHas('sim_category', function ($q) use ($type) {
            $q->where('alias', $type);
        });
    }

}
