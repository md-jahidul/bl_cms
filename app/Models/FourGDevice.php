<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class FourGDevice extends Model
{
    use LogModelAction;

    protected $fillable = [
        'offer_tag_id',
        'card_logo',
        'logo_alt_en',
        'logo_alt_bn',
        'thumbnail_image',
        'thumbnail_alt_en',
        'thumbnail_alt_bn',
        'title_en',
        'title_bn',
        'current_price',
        'old_price',
        'view_details_url',
        'buy_url',
        'product_status_en',
        'product_status_bn',
        'product_status_color',
        'status'
    ];

    public function deviceTags()
    {
        return $this->belongsToMany(FourGDeviceTag::class, 'four_g_device_tag_device', 'device_id', 'tag_id')
            ->withTimestamps();
    }
}
