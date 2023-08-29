<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = ['gateway_id', 'gateway_name', 'status', 'currency', 'logo_web', 'logo_mobile', 'type', 'display_order', 'logo_mobile_v2'];
}
