<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlSearchContent
 * @package App\Models
 */
class MyBlSearchContent extends Model
{
    protected $fillable = [
        'display_title',
        'description',
        'search_content',
        'navigation_action',
        'other_contents',
        'is_default'
    ];
}
