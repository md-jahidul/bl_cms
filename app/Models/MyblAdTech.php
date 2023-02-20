<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblAdTech extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'external_url',
        'display_order',
        'user_group_type',
        'base_groups_id',
        'status',
        'start_time',
        'end_time'
    ];
}
