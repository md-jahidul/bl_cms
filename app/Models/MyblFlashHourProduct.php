<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MyblFlashHourProduct extends Model
{
    protected $guarded = [];

    /**
     * @return MorphOne
     */
    public function notificationSchedule(): MorphOne
    {
        return $this->morphOne(NotificationSchedule::class, 'reference');
    }
}
