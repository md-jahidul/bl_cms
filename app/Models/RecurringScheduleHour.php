<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurringScheduleHour extends Model
{
    protected $fillable = ['used', 'scheduler_id', 'feature', 'start_time', 'end_time'];

}
