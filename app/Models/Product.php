<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * package App\Models
 */
class Product extends Model
{
    protected $fillable =
        [
            'code',
            'name_en',
            'name_bn',
            'price_tk',
            'price_vat_included',
            'ussd_en',
            'ussd_bn',
            'sms_volume',
            'min_volume',
            'internet_volume_mb',
            'bonus',
            'point',
            'validity_days',
            'is_recharge',
            'show_in_home',
            'tag_category_id',
            'sim_category_id',
            'offer_category_id',
            'contextual_message',
            'like',
            'status',
            'display_order',
        ];

    public function sim_category()
    {
        return $this->belongsTo(SimCategory::class);
    }

    public function scopeCategory($query, $type)
    {
        return $query->whereHas('sim_category', function ($q) use ($type) {
            $q->where('alias', $type);
        });
    }
}
