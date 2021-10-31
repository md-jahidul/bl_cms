<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\NotificationDraft;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository extends BaseRepository
{

    /**
     * @var Customer
     */
    protected $model;

    /**
     * CustomerRepository constructor.
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getCustomerList($request, array $user_phone, $notification_id)
    {
        $notificationInfo = NotificationDraft::find($notification_id);
        $sql = $this->model::whereIn('phone', $user_phone);
        if (!empty($notificationInfo->customer_type) && $notificationInfo->customer_type!=='all') {
            $sql->where('number_type', $notificationInfo->customer_type);
        }

        if (!empty($notificationInfo->device_type) && $notificationInfo->device_type!=='all') {
            $sql->where('device_type', $notificationInfo->device_type);
        }
        return $sql->pluck('phone')->toArray();
    }

    public function getLoggedOutCustomerList()
    {
        //return $this->model->where('last_login_at', '<>', null)->where('last_logout_at', '<>', null)->get();
        return DB::select(DB::raw("select * from customers where last_login_at < last_logout_at"));
    }
}
