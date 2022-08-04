<?php

namespace App\Models\NewCampaignModality;

use App\Models\RecurringScheduleHour;
use App\RecurringSchedule;
use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class MyBlCampaign extends Model
{
    use LogModelAction;

    protected $table = 'my_bl_campaigns';
    protected $appends = ['visibility_status'];
    protected $dates = ['start_date','end_date'];

    protected $fillable =
        [
            'mybl_campaign_section_id',
            'base_groups_id',
            'exclude_base_groups_id',
            'first_sign_up_user',
            'user_group_type',
            'name',
            'type',
            'winning_type',
            'winning_interval',
            'winning_interval_unit',
            'reward_bonus_code',
            "winning_massage_en",
            "winning_massage_bn",
            'deno_type',
            'recurring_type',
            'reward_getting_type',
            'bonus_reward_type',
            'bonus_product_code',
            'number_of_apply_times',
            'max_amount',
            'purchase_eligibility',
            'payment_gateways',
            'payment_channels',
            'start_date',
            'end_date',
            'status',
        ];

    public function products()
    {
        return $this->hasMany(MyBlCampaignDetail::class, 'my_bl_campaign_id', 'id');
    }

    public function section()
    {
        return $this->hasOne(MyBlCampaignSection::class, 'id', 'mybl_campaign_section_id');
    }

    public function schedule()
    {
        return $this->hasOne(RecurringSchedule::class, 'schedulable_item_id', 'id');
    }

    public function timeSlots()
    {
        return $this->hasMany(RecurringScheduleHour::class, 'scheduler_id', 'id');
    }

    public function getVisibilityStatusAttribute(): bool
    {
        return $this->visibilityStatus();
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

    public function reports(){
        return $this->hasMany(CampaignPurchaseReport::class, 'campaign_id', 'id');
    }
}
