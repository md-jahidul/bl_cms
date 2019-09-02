<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = ['slider_id','is_active', 'title','description','image_url','alt_text','url_btn_label','url','sequence'];
}
