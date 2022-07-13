<?php

namespace App\Models\NewCampaignModality;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MyBlCampaignDetail extends Model
{

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
            'cash_back_type',
            'max_amount',
            'number_of_apply_times',
            'purchase_eligibility',
            'product_category_slug',
            'product_code',
            'desc_en',
            'desc_bn',
            'show_in_home',
            'show_product_as',
            'start_date',
            'end_date',
            'status'
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
}
