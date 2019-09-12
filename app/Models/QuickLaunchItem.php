<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickLaunchItem extends Model
{
    protected $fillable = ['en_title', 'bn_title', 'image_url', 'alt_text', 'link', 'status', 'display_order'];
}
