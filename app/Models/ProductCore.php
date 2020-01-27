<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCore extends Model
{
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
        'sms_rate',
        'is_bundle',
        'is_auto_renewable',
        'is_recharge_offer',
        'is_gift_offer',
        'show_in_app',
        'offer_id',
        'is_amar_offer',
        'is_social_pack',
        'other_info',
        'status',
        'validity_in_days',
        'platform'

    ];

    protected $guarded = ['id'];


    public function product()
    {
        return $this->hasOne(Product::class, 'product_code', 'product_code');
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
