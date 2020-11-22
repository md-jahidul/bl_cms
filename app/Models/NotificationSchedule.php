<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSchedule extends Model
{
    protected $fillable = ['notification_id', 'file_name', 'start', 'end', 'status'];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
