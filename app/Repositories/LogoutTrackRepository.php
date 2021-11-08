<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\LogoutTrack;

class LogoutTrackRepository extends BaseRepository
{
    public $modelName = LogoutTrack::class;

    public function getLoggedOutCustomerList()
    {
        $notNotifiedLoggedOuts = LogoutTrack::select('customer_id', 'last_logout_at')->where('is_notified',
            false)->get();

        $notNotifiedCustomers = Customer::select('id', 'name', 'email', 'msisdn', 'device_type', 'number_type',
            'platform', 'last_login_at')->whereIn('id',
            $notNotifiedLoggedOuts->count() ? $notNotifiedLoggedOuts->pluck('customer_id') : [])->get();

        $loggedOutCustomers = null;

        foreach ($notNotifiedLoggedOuts as $notNotifiedLoggedOut) {
            $loggedOutCustomers = $notNotifiedCustomers->filter(function ($item) use ($notNotifiedLoggedOut) {
                return $item->where('last_login_at', '<', $notNotifiedLoggedOut->last_logout_at);
            });
        }

        return $loggedOutCustomers;
    }

}
