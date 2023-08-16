<?php

namespace App\Models\BlLab;

use Illuminate\Database\Eloquent\Model;

class BlLabStartupInfo extends Model
{
    protected $casts = [
        'business_model_file' => 'array',
        'gtm_plan_file' => 'array',
        'financial_metrics_file' => 'array',
    ];
}
