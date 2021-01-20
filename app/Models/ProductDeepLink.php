<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDeepLink extends Model
{
    protected $fillable = [
        'product_code',
        'deep_link',
        'total_view',
        'total_buy',
        'total_cancel',
        'buy_attempt',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDeeplinkDetails()
    {
        return $this->hasMany(ProductDeepLinkDetails::class, 'product_code_id', 'id');
    }
}
