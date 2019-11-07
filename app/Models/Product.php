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
            'offer_info',
        ];

    protected $casts = [
        'offer_info' => 'array'
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

    public function product_details()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function related_product()
    {
        return $this->hasMany(RelatedProduct::class);
    }
}
