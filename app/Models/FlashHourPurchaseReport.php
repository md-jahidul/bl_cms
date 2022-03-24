<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FlashHourPurchaseReport extends Model
{
    use LogModelAction;
    
    public function purchaseMsisdns(): HasMany
    {
        return $this->hasMany(FlashHourPurchaseMsisdnReport::class, 'purchase_report_id', 'id');
    }
}
