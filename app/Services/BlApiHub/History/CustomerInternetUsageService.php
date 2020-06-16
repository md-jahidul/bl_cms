<?php

namespace App\Services\BlApiHub\History;

use App\Enums\MyBlAppSettingsKey;
use App\Models\MyBlAppSettings;
use App\Services\BlApiHub\ApiBaseService;
use App\Services\BlApiHub\BaseService;
use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerInternetUsageService
 * @package App\Services\BlApiHub\History
 */
class CustomerInternetUsageService extends BaseService
{

    public $responseFormatter;
    protected const INTERNET_USAGE_API_ENDPOINT = "/usages-history/usages/customer-usages-history/internet-usages-history";
    protected const TRANSACTION_TYPE = "data_usage";
    /**
     * @var CustomerService
     */
    protected $customerService;

    public function __construct(ApiBaseService $apiBaseService, CustomerService $customerService)
    {
        $this->responseFormatter = $apiBaseService;
        $this->customerService = $customerService;
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $transactionType
     * @return Collection
     */
    public function getInternetUsageData($customer_id, $from, $to, $transactionType)
    {
        $response_data = $this->get($this->getInternetUsageUrl(
            $customer_id,
            $from,
            $to,
            $transactionType
        ));

        $formatted_internet_usage_data = $this->prepareInternetUsageHistory(json_decode($response_data['response']));

        $formatted_internet_usage_data = collect($formatted_internet_usage_data)->sortByDesc('start_time')->values();

        return $formatted_internet_usage_data;
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $transactionType
     * @return string
     */
    public function getInternetUsageUrl($customer_id, $from, $to, $transactionType)
    {
        return self::INTERNET_USAGE_API_ENDPOINT . "?" .
            "from=$from&to=$to&subscriptionId=$customer_id&transactionType=$transactionType";
    }

    /**
     * @param $amount
     * @return false|float
     */
    public function formatUnit($amount)
    {
        return round($amount / 1024 / 1024, 2); // given in Byte. converted to mb
    }

    /**
     * @param $format
     * @return bool
     */
    protected function checkValidDateFormat($format)
    {
        return (bool)strtotime($format);
    }

    /**
     * @param $amount
     * @return false|float
     */
    public function formatCost($amount)
    {
        return round($amount, 2); // given in paisa. converted to taka
    }

    public function getInternetUsageHistory($user, $from, $to)
    {
        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        $redis_key = "internet_usage:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$internet_usage = Redis::get($redis_key)) {
            $formatted_internet_usage_data = $this->getInternetUsageData(
                $customer_id,
                $from,
                $to,
                self::TRANSACTION_TYPE
            );

            $internet_usage = json_encode($formatted_internet_usage_data);
            Redis::setex($redis_key, $redis_ttl, $internet_usage);
        }

        $data = json_decode($internet_usage, true);
        return $this->responseFormatter->sendSuccessResponse($data, 'Internet Usage History');
    }

    public function prepareInternetUsageHistory($data)
    {
        $internet_data = [];
        if (!empty($data->data)) {
            foreach ($data->data as $usage_data) {
                $item = $usage_data->attributes;
                if ($item) {
                    $internet_data [] = [
                        'start_time' => Carbon::parse($item->eventAt)->setTimezone('UTC')->toDateTimeString(),
                        'end_time' => Carbon::parse($item->eventAt)->addSeconds($item->duration)
                            ->setTimezone('UTC')
                            ->toDateTimeString(),
                        'usage' => $this->formatUnit($item->dataAmount),
                        'cost' => $this->formatCost($item->transactionAmount)
                    ];
                }
            }
        }
        return $internet_data;
    }
}
