<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyblFlashHour extends Model
{
    protected $fillable = [
        'title',
        'base_msisdn_groups_id',
        'reference_type',
        'campaign_user_type',
        'start_date',
        'end_date',
        'status'
    ];

    public function flashHourProducts(): HasMany
    {
        return $this->hasMany(MyblFlashHourProduct::class, 'flash_hour_id', 'id');
    }

    public function checkCampaignExpire(): bool
    {
        $bdTimeZone = Carbon::now('Asia/Dhaka');
        $currentTime = $bdTimeZone->toDateTimeString();

        $startDate = $this->start_date;
        $endDate = $this->end_date;

        if (isset($startDate) && !($currentTime >= $startDate) || isset($endDate) && !($currentTime <= $endDate)) {
            return true;
        }
        return false;
    }
}
