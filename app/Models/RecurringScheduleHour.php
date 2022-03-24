<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class RecurringScheduleHour extends Model
{
    use LogModelAction;
    
    protected $fillable = ['used', 'scheduler_id', 'feature', 'start_time', 'end_time'];

}
