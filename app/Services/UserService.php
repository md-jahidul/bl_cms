<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\Auth;

class UserService
{
    use CrudTrait;

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
        $this->setActionRepository($userRepository);
    }

    public function getLeadUsers()
    {
        $featureType = Auth::user()->feature_type;
        return $this->userRepository->findByProperties(['feature_type' => $featureType]);
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
