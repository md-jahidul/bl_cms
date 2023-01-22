<?php

namespace App\Repositories;

use App\Enums\CustomerActivityType;
use App\Models\GuestCustomerActivity;

class GuestCustomerActivityRepository extends BaseRepository
{
    protected $modelName = GuestCustomerActivity::class;

    public function getLoggedOutCustomers()
    {
        $guestCustomerActivityBuilder = GuestCustomerActivity::whereIn('last_activity',
            [CustomerActivityType::GUEST, CustomerActivityType::LOGOUT])->where('is_notified', false);

        return $guestCustomerActivityBuilder;
    }
}
