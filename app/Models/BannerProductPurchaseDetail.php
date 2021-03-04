<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerProductPurchaseDetail extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getProductPurchaseBannerInfo()
    {
        return $this->belongsTo(BannerProductPurchase::class, 'id', 'banner_product_purchase_id');
    }
}
