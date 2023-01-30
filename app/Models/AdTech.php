<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdTech extends Model
{
    protected $fillable = [
        "reference_type",
        "reference_id",
        "img_url",
        "img_name_en",
        "img_name_bn",
        "alt_text_en",
        "alt_text_bn",
        "redirect_url_en",
        "redirect_url_bn",
        "is_external_url",
        "external_url",
        "status"
    ];
}
