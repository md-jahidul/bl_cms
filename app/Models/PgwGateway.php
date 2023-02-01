<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PgwGateway extends Model
{
    //
    protected $fillable =
    [
        'gateway_id',
        'gateway_name',
        'type',
        'status',
        'currency',
        'logo_web',
        'logo_mobile'
    ];
}
