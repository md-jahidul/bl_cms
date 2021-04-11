<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerAnalyticDetails extends Model
{
    protected $fillable = [
        'banner_analytic_id',
        'msisdn',
        'action_type',
        'session_time',
        'error_title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getAnalyticInfo()
    {
        return $this->belongsTo(BannerAnalytic::class, 'banner_analytic_id', 'id');
    }

}
