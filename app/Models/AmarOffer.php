<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AmarOffer extends Model
{
    use LogModelAction;

    protected $fillable = [
        'name',
        'user_group_type',
        'base_groups_id',
        'internet',
        'minutes',
        'sms',
        'validity',
        'price',
        'product_code',
        'tag',
        'validity_unit',
        'description',
        'status'
    ];
}
