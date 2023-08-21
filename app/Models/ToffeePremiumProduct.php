<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToffeePremiumProduct extends Model
{
    protected $fillable = [
        'toffee_subscription_type_id',
        'prepaid_product_codes',
        'postpaid_product_codes',
        'available_for_bl_users'
    ];

    /**
     * Get Product Info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriptionType()
    {
        return $this->belongsTo(ToffeeSubscriptionType::class, 'toffee_subscription_type_id', 'id');
    }

    public function availableForBlUsers(): bool
    {

        if ($this->available_for_bl_users == 1) return true;
        
        return false;
    }
}
