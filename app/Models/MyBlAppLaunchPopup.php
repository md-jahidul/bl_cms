<?php

namespace App\Models;

use App\RecurringSchedule;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MyBlAppLaunchPopup
 * @package App\Models
 */
class MyBlAppLaunchPopup extends Model
{
    protected $fillable = [
        'type',
        'title',
        'connection_type',
        'recurring_type',
        'start_date',
        'end_date',
        'content',
        'other_info',
        'created_by',
        'status',
        'product_code'
    ];

    public function schedule()
    {
        return $this->hasOne(RecurringSchedule::class, 'schedulable_item_id', 'id');
    }

    public function timeSlots()
    {
        return $this->hasMany(RecurringScheduleHour::class, 'scheduler_id', 'id');
    }

    public function purchaseLog()
    {
        return $this->hasOne(PopupProductPurchase::class, 'popup_id', 'id');
    }

    /**
     * Checks and returns the visibility status according to schedule stored with it
     * @return bool
     */
    public function visibilityStatus(): bool
    {
        $showFrom = $this->start_date ? strtotime($this->start_date) : 0;
        $hideFrom = $this->end_date ? strtotime($this->end_date) : 0;
        $currentTime = strtotime(date('Y-m-d H:i:s'));

        if (($currentTime >= $showFrom) && ($currentTime <= $hideFrom)) {
            if ($this->recurring_type == 'none') {
                return true;
            }
            // Returning false if recurring type is weekly and current day is out of scope
            if ($this->recurring_type == 'weekly') {
                $weekdays = explode(',', $this->schedule->weekdays);
                if (!in_array(strtolower(date('D')), $weekdays)) {
                    return false;
                }
            }
            // Returning false if recurring type is monthly and current date is out of scope
            if ($this->recurring_type == 'monthly') {
                $monthDates = explode(',', $this->schedule->month_dates);
                if (!in_array(date('j'), $monthDates)) {
                    return false;
                }
            }
            $timeSlots = $this->timeSlots;
            foreach ($timeSlots as $timeSlot) {
                $showFrom = strtotime(date('Y-m-d') . ' ' . $timeSlot->start_time);
                $hideFrom = strtotime(date('Y-m-d') . ' ' . $timeSlot->end_time);
                if (($currentTime >= $showFrom) && ($currentTime <= $hideFrom)) {
                    return true;
                }
            }
        }
        return false;
    }
}
