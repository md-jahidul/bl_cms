<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserMuteNotificationCategory;

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

        $users = Customer::whereIn('phone', $user_phone)->select('id')->get();

        $user_ids = array_map(function ($user) {
            return $user['id'];
        }, $users->toArray());

        $notification->users()->attach($user_ids);

        return 'success';
    }


    /**
     * @param $category_id
     * @param $user_phone
     * @return array
     */
    public function checkMuteOfferForUser($category_id, $user_phone): array
    {
        $user_ids = UserMuteNotificationCategory::where('category_id', $category_id)
                                                ->select('user_id')
                                                ->get()
                                                ->toArray();

        $phone_list = Customer::whereIn('id', $user_ids)
            ->select('phone')
            ->get()->toArray();

        $mute_user_phone = array_map(function ($phone) {
            return $phone['phone'];
        }, $phone_list);

        return array_diff($user_phone, $mute_user_phone);
    }


    /**
     * Notification report
     *
     * @return mixed
     */
    public function getNotificationReport()
    {
      return  Notification::join('notification_user', 'notifications.id', '=','notification_user.notification_id')
            ->join('customers', 'customers.id', '=', 'notification_user.user_id')
            ->get()->toArray();
    }

    /**
     * Notification target wise report
     *
     * @return mixed
     */
    public function getNotificationTargetReport($title)
    {

      return Notification::join('notification_user', 'notifications.id', '=','notification_user.notification_id')
            ->join('customers', 'customers.id', '=', 'notification_user.user_id')
            ->where('notifications.title',$title)
            ->select('mobile','status','title','body','notifications.created_at')
            ->orderBy('notifications.created_at','desc')
            ->get()->toArray();
    }

    /**
     * @param $category_id
     * @return array
     */
    public function getMuteUserPhoneList($category_id)
    {
        $user_ids = UserMuteNotificationCategory::where('category_id', $category_id)
            ->select('user_id')
            ->get()
            ->toArray();

        $phone_list = Customer::whereIn('id', $user_ids)
            ->select('phone')
            ->get()->toArray();

        $mute_user_phone = array_map(function ($phone) {
            return $phone['phone'];
        }, $phone_list);

        return $mute_user_phone;
    }


    /**
     * @param $user_phone
     * @param array $mute_user_phone
     * @return array
     */
    public function removeMuteUserFromList($user_phone, array $mute_user_phone)
    {
        return array_diff($user_phone, $mute_user_phone);
    }
}
