<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyblOrangeClubBanner extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'component_identifier',
        'redirect_url',
        'partner_details',
        'display_order',
        'user_group_type',
        'base_groups_id',
        'status',
        'start_time',
        'other_attributes',
        'end_time'
    ];
}