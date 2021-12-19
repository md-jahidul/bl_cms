<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestCustomerActivity extends Model
{
    protected $table = 'guest_customer_activities';

    protected $fillable = [
        'device_id',
        'fcm_token',
        'msisdn',
        'last_activity',
        'last_login_at',
        'last_logout_at',
        'device_type',
        'number_type',
        'login_status',
        'is_notified'
    ];
}
