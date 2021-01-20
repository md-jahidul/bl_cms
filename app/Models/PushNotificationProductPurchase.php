<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotificationProductPurchase extends Model
{

    protected $fillable = [
        'id',
        'notification_id',
        'notification_title',
        'product_code',
        'total_buy',
        'total_cancel',
        'total_buy_attempt',
        'is_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pushNotificationProductPurchaseLog()
    {
        return $this->hasMany(PushNotificationProductPurchaseDetails::class, 'push_notification_product_purchase_id', 'id');
    }
}
