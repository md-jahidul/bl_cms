<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FreeProductPurchaseReport extends Model
{
    public function purchaseMsisdns(): HasMany
    {
        return $this->hasMany(FreeProductPurchaseMsisdn::class, 'purchase_report_id', 'id');
    }
}
