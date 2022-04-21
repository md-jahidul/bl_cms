<?php

namespace App\Models;

use App\RecurringSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyBlOwnRechargeInvertory extends Model
{
    protected $fillable = ['title', 'description_bn', 'description_en', 'start_date', 'end_date', 'campaign_user_type', 'base_msisdn_groups_id', 'status',
                            'banner', 'thumbnail_image', 'partner_channel_names', 'purchase_eligibility', 'recurring_type',
                            'number_of_apply_times', 'max_amount', 'deno_type'];

    public function cashBackProducts(): HasMany
    {
        return $this->hasMany(MyBlOwnRechargeInvertoryProduct::class, 'own_recharge_id', 'id');
    }

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
        return $this->hasOne(PopupProductPurchase::class, 'own_recharge_id', 'id');
    }
}
