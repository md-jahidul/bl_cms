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

    public function findInIds($ids)
    {
        $idsOrdered = implode(',', $ids);
        return $this->model->whereIn('id', $ids)->orderByRaw("FIELD(id, $idsOrdered)");
    }
    public function findNotIn($ids)
    {
        return $this->model->whereNotIn('id', $ids);
    }

}
