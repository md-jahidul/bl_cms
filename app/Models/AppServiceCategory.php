<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppServiceCategory extends Model
{
    protected $fillable = ['app_service_tab_id', 'title_en', 'title_bn', 'alias', 'other_attributes'];
}
