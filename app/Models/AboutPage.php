<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use LogModelAction;
    protected $fillable = [
        'slug',
        'details_en',
        'details_bn',
        'left_side_img',
        'right_side_ing',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array',
    ];
}
