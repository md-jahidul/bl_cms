<?php
namespace App\Repositories;

use App\Models\Notification;
use App\Models\User;

class NotificationRepository extends BaseRepository
{
    public $modelName = Notification::class;


    /**
     * Attach Notification to user
     *
     * @param $notification_id
     * @param $user_phone
     * @return string
     */
    public function attachmentNotificationToUser($notification_id, $user_phone)
    {

        $notification = $this->modelName::find($notification_id);

        $users = User::whereIn('phone', $user_phone)->select('id')->get();


        $user_ids = array_map(function ($user) {
            return $user['id'];

        }, $users->toArray());

        $notification->users()->sync($user_ids);

        return 'success';

    }


}
