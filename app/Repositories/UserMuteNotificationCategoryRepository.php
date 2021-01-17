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
        return array_filter($this->model->select('user_id')->where('category_id', $categoryId)->get()->each(function ($user) {
            if (!empty($user->customer->phone)) {
                return $user->phone = $user->customer->phone;
            } else {
                return false;
            }
        })->pluck('phone')->toArray(), 'strlen');
    }

}
