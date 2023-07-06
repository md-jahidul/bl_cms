<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * package App\Models
 */
class Product extends Model
{
    use LogModelAction;
    
    protected $fillable =
        [
            'product_code',
            'url_slug',
            'url_slug_bn',
            'schema_markup',
            'page_header',
            'page_header_bn',
            'name_en',
            'name_bn',
            'start_date',
            'end_date',
            'ussd_bn',
            'balance_check_ussd_bn',
            'bonus',
            'point',
            'is_recharge',
            'show_in_home',
            'tag_category_id',
            'sim_category_id',
            'offer_category_id',
            'contextual_message',
            'like',
            'validity_postpaid',
            'status',
            'display_order',
            'purchase_option',
            'offer_info',
            'is_four_g_offer',
            'is_amar_offer',
            'is_social_pack',
            'is_auto_renewable',
            'rate_cutter_offer',
            'rate_cutter_unit',
            'call_rate_unit_bn',
            'sms_rate_unit_bn',
            'special_product',
            'created_by',
            'updated_by',
            
            'image',
        ];

    protected $casts = [
        'offer_info' => 'array',
    ];


    public function product_core()
    {
        return $this->belongsTo(AlCoreProduct::class, 'product_code', 'product_code');
    }

    public function scopeProductCore($query)
    {
        return $query->with(['product_core' => function ($q) {
            $q->select(
                'product_code',
                'activation_ussd as ussd_en',
                'balance_check_ussd',
                'price',
                'vat',
                'mrp_price as price_tk',
                'validity as validity_days',
                'validity_unit',
                'internet_volume_mb',
                'sms_volume',
                'minute_volume',
                'call_rate as callrate_offer',
                'sms_rate as sms_rate_offer',
                'renew_product_code',
                'recharge_product_code'
            );
        }]);
    }

    public function sim_category()
    {
        return $this->belongsTo(SimCategory::class);
    }

    public function offer_category()
    {
        return $this->belongsTo(OfferCategory::class);
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

    public function other_related_product()
    {
        return $this->hasMany(OtherRelatedProduct::class);
    }


}
