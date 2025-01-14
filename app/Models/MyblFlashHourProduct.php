<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyblFlashHourProduct extends Model
{
    use LogModelAction;
    protected $guarded = [];

    /**
     * @return MorphOne
     */
    public function notificationSchedule(): MorphOne
    {
        return $this->morphOne(NotificationSchedule::class, 'reference')->where('status', 'active');
    }

    public function flashHour()
    {
        return $this->belongsTo(MyblFlashHour::class);
    }

    public function checkCampaignProductExpire(): bool
    {
        $bdTimeZone = Carbon::now('Asia/Dhaka');
        $currentTime = $bdTimeZone->toDateTimeString();

        $startDate = $this->start_date;
        $endDate = $this->end_date;

        if (($currentTime > $startDate) && isset($startDate) && !($currentTime >= $startDate) || isset($endDate) && !($currentTime <= $endDate)) {
            return true;
        }
        return false;
    }
}
