<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    protected $userRepository;


    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Retrieve User info
     *
     * @return mixed
     */
    public function getUserListForNotification()
    {
        return $this->userRepository->getUserListForNotification();
    }

    public function storeUser($data)
    {
    }
}
