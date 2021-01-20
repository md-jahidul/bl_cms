<?php

namespace App\Repositories;

use App\Models\UserMuteNotificationCategory;

class UserMuteNotificationCategoryRepository extends BaseRepository
{
    public $modelName = UserMuteNotificationCategory::class;

    /**
     * @param $categoryId
     * @return mixed
     */
    public function getUsersPhoneByCategory($categoryId)
    {
        return $this->model->select('user_id', 'phone')
            ->where('user_mute_notification_category.category_id', $categoryId)
            ->leftJoin('customers', 'user_mute_notification_category.user_id', '=', 'customers.id')
            ->get()
            ->pluck('phone')
            ->toArray();
    }

}
