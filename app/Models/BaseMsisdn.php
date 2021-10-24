<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseMsisdn extends Model
{
    protected $fillable = [
        'group_id',
        'msisdn',
        'created_at'
    ];
}
