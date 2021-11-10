<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\LogoutTrack;
use Carbon\Carbon;

class LogoutTrackRepository extends BaseRepository
{
    public $modelName = LogoutTrack::class;

    public function getLoggedOutCustomerList($request, $start = 0, $length = 0)
    {
        $notNotifiedLoggedOuts = LogoutTrack::select('customer_id', 'last_logout_at')->where('is_notified',
            false)->get();

        $customerBuilder = Customer::select('id', 'name', 'email', 'msisdn', 'device_type', 'number_type',
            'platform', 'last_login_at')->whereIn('id',
            $notNotifiedLoggedOuts->count() ? $notNotifiedLoggedOuts->pluck('customer_id') : []);

        if ($request->time_range) {
            $scheduleArr = explode('-', $request->time_range);
            $startTime = Carbon::parse(trim($scheduleArr[0]))->format('Y-m-d H:i:s');
            $endTime = Carbon::parse(trim($scheduleArr[1]))->format('Y-m-d H:i:s');
            $notNotifiedLoggedOuts->whereBetween('updated_at', [$startTime, $endTime]);
        }

        if ($request->device_type) {
            $customerBuilder->where('device_type', $request->device_type);
        }

        if ($request->number_type) {
            $customerBuilder->where('number_type', $request->number_type);
        }

        $notNotifiedCustomers = collect([]);

        if ($request->has('search') && !empty($request->get('search'))) {
            $input = $request->get('search');
            if (!empty($input['value'])) {
                $title = $input['value'];
                $notNotifiedCustomers = $customerBuilder->where('name', 'LIKE',
                    "%{$title}%")->skip($start)->take($length)->get();

            } else {
                $notNotifiedCustomers = $customerBuilder->skip($start)->take($length)->get();
            }
        }

        $loggedOutCustomers = null;

        foreach ($notNotifiedLoggedOuts as $notNotifiedLoggedOut) {
            $loggedOutCustomers = $notNotifiedCustomers->filter(function ($item) use ($notNotifiedLoggedOut) {
                return $item->where('last_login_at', '<', $notNotifiedLoggedOut->last_logout_at);
            });

        }

        return $loggedOutCustomers;
    }

}
