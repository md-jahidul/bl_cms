<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotificationProductPurchaseDetails extends Model
{
    protected $fillable = [
        'id',
        'push_notification_product_purchase_id',
        'msisdn',
        'action_type'
    ];
}
