<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\NotificationDraft;
use App\Models\User;
use App\Models\UserMuteNotificationCategory;

class NotificationRepository extends BaseRepository
{
    public $modelName = NotificationDraft::class;


    /**
     * Attach Notification to user
     *
     * @param $notification_id
     * @param $user_phone
     * @param $notification_info
     * @return string
     */
    public function attachmentNotificationToUser($notification_id, $user_phone, $notification_info)
    {

        $notification = $this->modelName::find($notification_id);

        $users = Customer::whereIn('phone', $user_phone)->select('id')->get();

        $json_data['title'] = $notification_info['title'];
        $json_data['message'] = $notification_info['body'];

        $user_ids = array_map(function ($user) {
            return $user['id'];
        }, $users->toArray());

        $notification->users()->attach($user_ids, ['notification_info' => json_encode($json_data)]);

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
}
