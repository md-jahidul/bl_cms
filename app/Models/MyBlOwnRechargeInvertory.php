<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MyBlOwnRechargeInvertory extends Model
{
    protected $fillable = ['title', 'description_bn', 'description_en', 'start_date', 'end_date', 'campaign_user_type', 'base_msisdn_groups_id', 'status',
                            'banner', 'thumbnail_image', 'partner_channel_names', 'purchase_eligibility'];

    public function cashBackProducts(): HasMany
    {
        return $this->hasMany(MyBlOwnRechargeInvertoryProduct::class, 'own_recharge_id', 'id');
    }
}
