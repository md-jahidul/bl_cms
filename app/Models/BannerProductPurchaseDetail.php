<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class BannerProductPurchaseDetail extends Model
{
    use LogModelAction;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getProductPurchaseBannerInfo()
    {
        return $this->belongsTo(BannerProductPurchase::class, 'id', 'banner_product_purchase_id');
    }
}
