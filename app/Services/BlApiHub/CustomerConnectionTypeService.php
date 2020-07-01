<?php

namespace App\Services\BlApiHub;


use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerConnectionTypeService
 * @package App\Services\BlApiHub
 */
class CustomerConnectionTypeService extends BaseService
{
    protected $responseFormatter;
    protected const CUSTOMER_ENDPOINT = "/customer-information/customer-information";

    public function __construct()
    {
        $this->responseFormatter = new BaseService();
    }

    /**
     * @param $msisdn
     * @return string
     */
    private function getConnectionTypeInfoUrl($msisdn)
    {
        return self::CUSTOMER_ENDPOINT . "?include=SUBSCRIPTION_TYPES&msisdn=" . $msisdn;
    }

    /**
     * @param $msisdn
     * @return |null
     */
    public function getConnectionTypeInfo($msisdn)
    {
        if (!$connection_type = Redis::get('connection_type:' . $msisdn)) {
            $response = $this->get($this->getConnectionTypeInfoUrl($msisdn));
            $response = json_decode($response['response']);

            if (!$response) {
                return null;
            }
            if (isset($response->error)) {
                return null;
            }

            Redis::setex('connection_type:' . $msisdn, 60 * 60 * 24, $response->connectionType);
            return $response->connectionType;
        }

        return $connection_type;
    }

    /**
     * @param $msisdn
     * @return array|mixed
     */
    public function getConnectionInfo($msisdn)
    {
        $response = $this->get($this->getConnectionTypeInfoUrl($msisdn));
        $response = json_decode($response['response'], true);
        if (!$response) {
            return [];
        }
        if (isset($response->error)) {
            return [];
        }

        return $response;
    }
}
