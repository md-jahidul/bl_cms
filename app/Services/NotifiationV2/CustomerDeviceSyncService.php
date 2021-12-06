<?php

namespace App\Services\NotifiationV2;

use \GuzzleHttp\Client as Http;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerDeviceSyncService
{

    use CrudTrait;

    private $Http;

    public function __construct()
    {
        $this->Http = new Http();
    }

    public function pushCustomersDevicesTable($allCustomersAndMsisdns)
    {
        $body = [
            'allCustomers'      => $allCustomersAndMsisdns['allCustomers'],
            'customersMsisdns'  => $allCustomersAndMsisdns['customersMsisdns']
        ];
        $this->Http->request('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'customersDevices/store', ['json' => $body]);
    }

    public function getCustomersDevices()
    {
        $allCustomer = DB::table('customers_devices')->get();
    
        $customersMsisdns = $allCustomer->pluck('msisdn');
        
        return [
            "customersMsisdns"  => $customersMsisdns,
            "allCustomers"      => $allCustomer
        ];
    }
}
