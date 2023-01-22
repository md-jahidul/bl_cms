<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
use App\Traits\LogModelAction;

class NotificationDraft extends Model
{
    use LogModelAction;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification_drafts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'body',
        // 'cta_name',
        // 'cta_action',
        // 'notification_type',
        'quick_notification',
        'device_type',
        'customer_type',
        'navigate_action',
        'external_url',
        'image',
        'starts_at',
        'expires_at',
        'quick_notification'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function NotificationCategory()
    {
        return $this->belongsTo(NotificationCategory::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            NotificationUser::class,
            'notification_user',
            'notification_id',
            'user_id'
        )->withTimestamps();
    }

    public function getNotification(){
        return $this->hasMany(Notification::class, 'title', 'title');
    }

    public function getNotificationSuccessfullySend(){
        return $this->hasMany(Notification::class, 'title', 'title')->where('status','SUCCESSFUL');
    }

    public function schedule()
    {
        return $this->hasOne(NotificationSchedule::class);
    }


}
