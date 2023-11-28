<?php

namespace App\Models\NewCampaignModality;

use App\Models\NotificationSchedule;
use App\Traits\LogModelAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyBlCampaignDetail extends Model
{
    use LogModelAction;

    protected $table = 'my_bl_campaign_details';
    protected $appends = ['visibility_status'];
    protected $dates = ['start_date','end_date'];

    protected $fillable =
        [
            'my_bl_campaign_id',
            'recharge_amount',
            'cash_back_amount',
            'banner_image',
            'thumb_image',
            'popup_image',
            'popup_img_portrait',
            'cash_back_type',
            'max_amount',
            'number_of_apply_times',
            'purchase_eligibility',
            'product_category_slug',
            'product_code',
            'product_for',
            'desc_en',
            'desc_bn',
            'show_in_home',
            'show_product_as',
            'start_date',
            'end_date',
            'status',
            'max_recharge_amount',
            'bonus_product_code',
            'numbers_of_get_bonus'
        ];

        public function campaign()
        {
            return $this->belongsTo(MyBlCampaign::class, 'my_bl_campaign_id', 'id');
        }

        public function getVisibilityStatusAttribute(): bool
        {
            $showFrom = $this->start_date ? Carbon::parse($this->start_date) : 0;
            $hideFrom = $this->end_date ? Carbon::parse($this->end_date) : 0;
            $currentTime = Carbon::now();

            return $currentTime->greaterThan($showFrom) && $currentTime->lessThan($hideFrom);
        }

        /**
         * @return MorphOne
         */
        public function notificationSchedule(): MorphOne
        {
            return $this->morphOne(NotificationSchedule::class, 'reference')->where('status', 'active');
        }
}
