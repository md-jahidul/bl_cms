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

    public function __construct()
    {
        $this->responseFormatter = new BaseService();
    }

    private function getAvailableProductByPackageUrl($customer_package_id, $channelName): string
    {
        return self::CUSTOMER_ENDPOINT . '/product-catalog/' . $customer_package_id . '?channel=' . $channelName;
    }

    public function getAvailableProductsByCustomer()
    {
        try {
            $customerPackageArray = config('constants.customer_package_list');
            $channelName = config('constants.channel_name');

            foreach ($customerPackageArray as $packageId) {
                $products = Redis::get('a_p:' . $packageId);

                if (!$products || count(collect(json_decode($products))) == 0) {
                    $response = $this->get($this->getAvailableProductByPackageUrl($packageId,$channelName));
                    $products = json_decode($response['response']);
                    $collection = collect($products)->groupBy('templateType');

                    $available_products = [];

                    foreach ($collection as $key => $item) {
                        foreach ($item as $val) {
                            $available_products[] = $val->code;
                        }
                    }

                    Redis::setex('a_p:' . $packageId, 60 * 60 * 24, json_encode($available_products));
                }
            }

            return $available_products;
        } catch (\Exception $e) {
            Log::info('Available Product cache By package update Error:' . $e->getMessage());
        }
    }

}
