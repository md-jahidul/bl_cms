<?php

namespace App\Models;

use App\Traits\LogModelAction;
use Illuminate\Database\Eloquent\Model;

class NotificationSchedule extends Model
{
    use LogModelAction;
    protected $fillable = ['notification_draft_id', 'notification_category_id', 'title', 'message', 'file_name', 'start', 'end', 'status'];

    public function notificationDraft()
    {
        return $this->belongsTo(NotificationDraft::class, 'notification_draft_id', 'id');
    }

    public function notificationCategory()
    {
        return $this->belongsTo(NotificationCategory::class, 'notification_category_id');
    }
}

