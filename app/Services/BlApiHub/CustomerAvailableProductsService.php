<?php

namespace App\Services\BlApiHub;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerAvailableProductsService
 * @package App\Services\BlApiHub
 */
class CustomerAvailableProductsService extends BaseService
{
    protected $responseFormatter;
    protected const CUSTOMER_ENDPOINT = "/customer-information/customer-information";
    protected $connectTimeout = 2;
    protected $requestTimeout = 5;

    public function __construct()
    {
        $this->responseFormatter = new BaseService();
    }

    private function getAvailableProductByPackageUrl($customer_package_id, $channelName): string
    {
        return self::CUSTOMER_ENDPOINT . '/product-catalog/' . $customer_package_id . '?channel=' . $channelName;
    }

    public function getAvailableProductsByPackage()
    {
        try {
            $customerPackageArray = config('constants.customer_package_list');
            $channelName = config('constants.channel_name');

            foreach ($customerPackageArray as $packageId) {
                $this->packageWiseRedisCache($packageId, $channelName);
            }

        } catch (\Exception $e) {
            Log::channel('available-product-cache-log')->info(
                'Available Product cache By package update Error:' . $e->getMessage()
            );
        }
    }

    private function packageWiseRedisCache($packageId, $channelName)
    {
        try {
            $response = $this->get($this->getAvailableProductByPackageUrl($packageId,$channelName));
            $products = json_decode($response['response']);

            if (!empty($products)) {
                $collection = collect($products)->groupBy('templateType');
                $available_products = [];

                foreach ($collection as $key => $item) {
                    foreach ($item as $val) {
                        $available_products[] = $val->code;
                    }
                }

                Redis::setex('a_p:' . $packageId, 60 * 60 * 24, json_encode($available_products));
            } else {
                Log::channel('available-product-cache-log')->info(
                    "Available Product cache update Failure ({$packageId}): " . json_encode($response)
                );
            }
        } catch (\Exception $e) {
            Log::channel('available-product-cache-log')->info(
                'Available Product cache By package update Error ('.$packageId.'):' . $e->getMessage()
            );
        }
    }

}
