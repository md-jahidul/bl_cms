<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class FourGCampaign extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'title', 'details_en',
        'details_bn', 'image_url',
        'alt_text_en', 'created_by',
        'updated_by', 'status'
    ];
}
