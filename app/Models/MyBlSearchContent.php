<?php

namespace App\Models;

use App\Traits\FullTextSearchTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlSearchContent
 * @package App\Models
 */
class MyBlSearchContent extends Model
{
    use FullTextSearchTrait;

    protected $fillable = [
        'display_title',
        'description',
        'search_content',
        'navigation_action',
        'other_contents',
        'is_default',
        'connection_type',
        'deeplink'
    ];

    protected $searchable = [
        'display_title',
        'navigation_action',
        'search_content'
    ];
}
