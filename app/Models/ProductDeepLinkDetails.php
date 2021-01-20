<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDeepLinkDetails extends Model
{
    protected $fillable = [
        'product_code_id',
        'msisdn',
        'action_type',
        'action_status',
        'action_url'
    ];
}
