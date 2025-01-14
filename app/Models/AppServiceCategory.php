<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class AppServiceCategory extends Model
{
    use LogModelAction;
    
    protected $fillable = ['app_service_tab_id', 'title_en', 'title_bn', 'alias', 'other_attributes', 'status'];

    public function appServiceTab()
    {
        return $this->belongsTo(AppServiceTab::class, 'app_service_tab_id', 'id');
    }
}
