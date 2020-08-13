<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FourGCampaign extends Model
{
    protected $fillable = [
        'title', 'details_en',
        'details_bn', 'image_url',
        'alt_text_en', 'created_by',
        'updated_by', 'status'
    ];
}
