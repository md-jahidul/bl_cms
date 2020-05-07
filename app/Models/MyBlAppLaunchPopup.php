<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlAppLaunchPopup
 * @package App\Models
 */
class MyBlAppLaunchPopup extends Model
{
    protected $fillable = [
        'type',
        'title',
        'start_date',
        'end_date',
        'content',
        'other_info',
        'created_by',
        'status'
    ];
}
