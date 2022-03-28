<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class ProductDeepLinkDetails extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'product_code_id',
        'msisdn',
        'action_type',
        'action_status',
        'action_url'
    ];
}
