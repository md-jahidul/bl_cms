<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'user_email',
        'ip_address',
        'event',
        'is_success'
    ];
}
