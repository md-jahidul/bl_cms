<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsLanding extends Model
{
    protected $fillable = ['component_type', 'title_en', 'title_bn', 'description_en', 'description_bn'];
}
