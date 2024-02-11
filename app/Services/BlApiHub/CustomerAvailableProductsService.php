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
    protected const CACHE_KEY_PREFIX = "a_p:";
    protected $connectTimeout = 2;
    protected $requestTimeout = 5;
    protected $cacheKeyListForDelete = [];

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
            $customerPackageList = config('constants.customer_package_list');
            $channelName = config('constants.channel_name');

            if (empty($customerPackageList)) {
                throw new \Exception('Customer Package list not configured');
            }

            foreach ($customerPackageList as $packageId) {
                $this->packageWiseRedisCache($packageId, $channelName);
            }

            if (!empty($this->cacheKeyListForDelete)) {
                Redis::del($this->cacheKeyListForDelete);

                Log::channel('available-product-cache-log')->info(
                    'Available Product cache By package update: Deleted Keys'. json_encode($this->cacheKeyListForDelete)
                );
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

                Redis::setex(self::CACHE_KEY_PREFIX . $packageId, 60 * 60 * 24, json_encode($available_products));
            } else {
                $this->cacheKeyListForDelete[] = self::CACHE_KEY_PREFIX . $packageId;

                Log::channel('available-product-cache-log')->info(
                    "Available Product cache update Failure ({$packageId}): " . json_encode($response)
                );
            }
        } catch (\Exception $e) {
            $this->cacheKeyListForDelete[] = self::CACHE_KEY_PREFIX . $packageId;

            Log::channel('available-product-cache-log')->info(
                'Available Product cache By package update Error ('.$packageId.'):' . $e->getMessage()
            );
        }
    }
}
