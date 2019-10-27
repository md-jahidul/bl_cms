<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends BaseRepository
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
        $users = $this->model->get();
        return $users;
    }



}
