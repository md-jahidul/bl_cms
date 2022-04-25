<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class PushNotificationProductPurchaseDetails extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'id',
        'push_notification_product_purchase_id',
        'msisdn',
        'action_type'
    ];
}
