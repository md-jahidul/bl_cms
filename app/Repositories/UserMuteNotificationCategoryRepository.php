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
        return $this->model->select('user_id')->where('category_id', $categoryId)->get()->each(function ($user) {
            return $user->phone = $user->customer->phone;
        })->pluck('phone')->toArray();
    }

}
