<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBlDigitalService extends Model
{
    protected $fillable = [
        'header_title_en',
        'header_title_bn',
        'body_title_en',
        'body_title_bn',
        'button_title_en',
        'button_title_bn',
        'component_for',
        'status',
        'header_sub_title_en',
        'header_sub_title_bn',
        'body_sub_title_en',
        'body_sub_title_bn'
    ];
}
