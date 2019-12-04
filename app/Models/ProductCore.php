<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCore extends Model
{
    protected $fillable = [
        'product_code',
        'product_name',
        'product_short_dec',
        'ussd_activation_code',
        'balance_check_ussd',
        'ussd_short_dec',
        'product_price',
        'product_total_price',
        'product_vat',
        'product_validity',
        'product_validity_unit',
        'product_content_type',
        'product_family',
        'product_sms_count',
        'internet_volume_mb',
        'minute_volume',
        'sms_volume',
        'call_rate',
        'sms_rate',
        'product_type_id',
        'is_bundle',
        'is_reactivable',
        'status',
        'product_segment',
        'product_sim_package',
    ];

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
