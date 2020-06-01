<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickLaunchItem extends Model
{
    protected $fillable = ['title_en', 'title_bn', 'image_url', 'alt_text', 'link', 'is_external_link', 'type', 'status', 'display_order'];
}
