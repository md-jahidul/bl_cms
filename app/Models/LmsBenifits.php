<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class LmsBenifits extends Model
{
    use LogModelAction;
    
    protected $fillable = [
        'page_type', 'title_en', 'title_en', 'image_url', 'alt_text_en',
        'display_order', 'status'
    ];
}
