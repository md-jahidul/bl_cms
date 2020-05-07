<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppServiceProduct extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'other_info' => 'array'
    ];

    public function appServiceTab()
    {
        return $this->belongsTo(AppServiceTab::class, 'app_service_tab_id', 'id');
    }

    public function appServiceCat()
    {
        return $this->belongsTo(AppServiceCategory::class, 'app_service_cat_id', 'id');
    }

    public function scopeProductTabType($query, $type)
    {
        return $query->whereHas('appServiceTab', function ($q) use ($type) {
            $q->where('alias', $type);
        });
    }

}
