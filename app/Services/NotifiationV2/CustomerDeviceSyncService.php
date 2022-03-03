<?php

namespace App\Services\NotifiationV2;

use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerDeviceSyncService
{
    use CrudTrait;

    public function pushCustomersDevicesTable($allCustomersAndMsisdns)
    {
        if(empty($allCustomersAndMsisdns['allCustomers'] || $allCustomersAndMsisdns['customersMsisdns'])) {
            return 'Payload Empty';
        }

        $body = [
            'allCustomers'      => $allCustomersAndMsisdns['allCustomers'],
            'customersMsisdns'  => $allCustomersAndMsisdns['customersMsisdns']
        ];
      
        [$get_data, $info] = $this->callAPI('POST', env('NOTIFICATION_MODULE_BASE_URL') . 'customersDevices/store', $body);

        return $get_data;
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

    public function freshSync()
    {
        $listMsisdnCustomers = DB::table('customers')
                ->pluck('phone')
                ->toArray();

        $listMsisdnCustomersDevices = DB::table('customers_devices')
                            ->pluck('msisdn')
                            ->toArray();
        
        $listUniquePhoneNubmer = array_diff($listMsisdnCustomers, $listMsisdnCustomersDevices);

        $customersList = DB::table('customers')->when(is_array($listUniquePhoneNubmer), 
                        function($q) use ($listUniquePhoneNubmer) {
                            return $q->whereIn('phone', $listUniquePhoneNubmer);
                        })->select('phone', 'device_token', 'device_type', 'number_type')->get();

        $bulk = array();

        foreach($customersList as $customer)
        {
            $data = [
                'msisdn'            => $customer->phone ? $customer->phone : "",
                'device_token'      => $customer->device_token ? $customer->device_token : "",
                'device_type'       => $customer->device_type ? $customer->device_type : "",
                'customer_type'     => $customer->number_type ? $customer->number_type : ""
            ];

            $bulk [] = $data;
        }

        return DB::table('customers_devices')->insert($bulk);
    }

    private function callAPI($method, $url, $data=[], $header=[], $auth=false)
    {
        $curl = curl_init();

        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if (!empty($data))
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if (!empty($data))
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if (!empty($data))
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        // Set URL
        curl_setopt($curl, CURLOPT_URL, $url);
        // Set Return 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // Set SSL Disable
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if(!empty($header)) {
            // Set HEADER
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
             ));
        }
        
        if($auth) {
            // Set Auth
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }
        
        try {
            // EXECUTE:
            $result = curl_exec($curl);     
        } catch(\Exception $e) {
            $errorJson = json_encode([
                "status" => "FAIL",
                "status_code" => 422,
                "error" => [
                    "message" => "Notification Module Connection Error"
                ]
            ]);

            http_response_code(422);
            exit($errorJson);
        }

        // INFO:
        $info = curl_getinfo($curl);

        if(!$result) {
            $errorJson = json_encode([
                "status" => "FAIL",
                "status_code" => 422,
                "error" => [
                    "message" => "Notification Module Connection Error"
                ]
            ]);

            http_response_code(422);
            exit($errorJson);
        }

        curl_close($curl);

        return [$result, $info];
    }
}
