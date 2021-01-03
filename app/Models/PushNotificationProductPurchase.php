<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotificationProductPurchase extends Model
{
    protected $fillable = [
        'notification_id',
        'notification_title',
        'product_code',
        'total_buy',
        'total_cancel',
        'total_buy_attempt',
        'is_delete'
    ];
}
