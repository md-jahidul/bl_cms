<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GenericSliderImage extends Model
{
    protected $fillable = [
        'generic_slider_id',
        'title',
        'description',
        'image_url',
        'alt_text',
        'user_type',
        'url_btn_label',
        'redirect_url',
        'web_deep_link',
        'sequence',
        'status',
        'start_date',
        'end_date',
        'display_type',
        'ussd_code',
        'message_en',
        'message_bn',
        'other_attributes',
    ];

    protected $casts = [
        'other_attributes' => 'array'
    ];

    public function slider()
    {
        return $this->belongsTo(GenericSlider::class, 'generic_slider_id', 'id');
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
//        dd($startDate, $endDate, $this->status);
        if ($this->status == 1) {
            if (isset($startDate) && !($currentTime >= $startDate) || isset($endDate) && !($currentTime <= $endDate)) {
                return false;
            }
            return true;
        }
        return false;
    }
}
