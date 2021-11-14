<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestCustomerActivity extends Model
{
    protected $fillable = [
        'device_id',
        'fcm_token',
        'msisdn',
        'type',
        'last_login_at',
        'last_logout_at',
        'login_status',
        'is_notified'
    ];
}
