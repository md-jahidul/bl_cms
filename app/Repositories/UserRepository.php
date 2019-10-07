<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve User info
     *
     * @return mixed
     */
    public function getUserListForNotification()
    {
        $users = $this->model->where('role_id', 5)->get();

        return $users;
    }



}
