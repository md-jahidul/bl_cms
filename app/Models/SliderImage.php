<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    use LogModelAction;

    protected $fillable = [
            'slider_id',
            'title',
            'alt_text',
            'url_btn_label',
            'redirect_url',
            'description',
            'is_active',
            'image_url',
            'sequence',
            'other_attributes',
            'user_type',
            'start_date',
            'end_date',
            'display_type',
            'web_deep_link',
            'partner_details',
            'ussd_code',
            'message_en',
            'message_bn'
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function baseImageCats()
    {
        return $this->hasMany(BaseImageCta::class, 'banner_id', 'id');
    }

    public function scopeStartEndDate($query)
    {
        $bdTimeZone = Carbon::now('Asia/Dhaka');
        $dateTime = $bdTimeZone->toDateTimeString();

        return $query->where(function ($query) use ($dateTime) {
            $query->where('start_date', '<=', $dateTime)
                ->orWhereNull('start_date');
        })
        ->where(function ($query) use ($dateTime) {
            $query->where('end_date', '>=', $dateTime)
                ->orWhereNull('end_date');
        });
    }

    public function visibilityStatus(): bool
    {
        $bdTimeZone = Carbon::now('Asia/Dhaka');
        $currentTime = $bdTimeZone->toDateTimeString();

        $startDate = $this->start_date;
        $endDate = $this->end_date;

        if ($this->is_active == 1) {
            if (isset($startDate) && !($currentTime >= $startDate) || isset($endDate) && !($currentTime <= $endDate)) {
                return false;
            }
            return true;
        }
        return false;
    }
}
