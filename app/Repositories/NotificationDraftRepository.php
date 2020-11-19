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
    }

}
