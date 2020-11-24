<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSchedule extends Model
{
    protected $fillable = ['notification_draft_id', 'notification_category_id', 'file_name', 'start', 'end', 'status'];

    public function notificationDraft()
    {
        return $this->belongsTo(NotificationDraft::class, 'notification_draft_id', 'id');
    }

    public function notificationCategory()
    {
        return $this->belongsTo(NotificationCategory::class, 'notification_category_id');
    }
}

