<?php

namespace App\Repositories;

use App\Models\NotificationDraft;

class NotificationDraftRepository extends BaseRepository
{
    public $modelName = NotificationDraft::class;

  /**
     * Notification report
     *
     * @return mixed
     */
    public function getNotificationReport()
    {
        return NotificationDraft::findAll();
    //   return  Notification::join('notification_user', 'notifications.id', '=','notification_user.notification_id')
    //         ->join('customers', 'customers.id', '=', 'notification_user.user_id')
    //         ->get()->toArray();
    }

}
