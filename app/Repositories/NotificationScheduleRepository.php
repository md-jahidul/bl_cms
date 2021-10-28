<?php

/**
 * Created by PhpStorm.
 * User: Shohag
 * Date: 22-Nov-20
 * Time: 8:00 PM
 */

namespace App\Repositories;

use App\Models\AboutPage;
use App\Models\NotificationSchedule;
use App\Models\Prize;

class NotificationScheduleRepository extends BaseRepository
{

    protected $modelName = NotificationSchedule::class;

    public function getCompletedNotificationDraftIds()
    {
        return $this->model->select('start', 'notification_draft_id')->where('status', 'completed')
            ->orderBy('start', 'DESC')->pluck('notification_draft_id')->all();
    }

}
