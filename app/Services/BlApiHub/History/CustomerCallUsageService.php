<?php

namespace App\Services\BlApiHub\History;

use App\Enums\MyBlAppSettingsKey;
use App\Models\MyBlAppSettings;
use App\Services\BlApiHub\ApiBaseService;
use App\Services\BlApiHub\BaseService;
use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerCallUsageService
 * @package App\Services\BlApiHub\History
 */
class CustomerCallUsageService extends BaseService
{

    public $responseFormatter;
    protected const CALL_USAGE_API_ENDPOINT = "/usages-history/usages/customer-usages-history/call-usages-history";
    protected const INCOMING_TRANSACTION_TYPE = "incoming_calls";
    protected const OUTGOING_TRANSACTION_TYPE = "outgoing_calls";
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
     * @param $format
     * @return bool
     */
    protected function checkValidDateFormat($format)
    {
        return (bool)strtotime($format);
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $transactionType
     * @return string
     */
    public function getCallUsageUrl($customer_id, $from, $to, $transactionType)
    {
        return self::CALL_USAGE_API_ENDPOINT . "?" .
            "from=$from&to=$to&subscriptionId=$customer_id&transactionType=$transactionType";
    }

    /**
     * @param $amount
     * @return int
     */
    private function formatUnit($amount)
    {
        return (int) $amount;
    }

    /**
     * @param $amount
     * @return false|float
     */
    private function formatCost($amount)
    {
        return round($amount, 2); // given in tk.
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $transaction_type
     * @return mixed
     */
    public function getIncomingUsage($customer_id, $from, $to, $transaction_type)
    {
        $redis_key = "incoming_call:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$call_usage = Redis::get($redis_key)) {
            $response_data = $this->get($this->getCallUsageUrl($customer_id, $from, $to, $transaction_type));
            $data = $this->prepareIncomingUsageHistory(json_decode($response_data['response']));

            $call_usage = json_encode($data);
            Redis::setex($redis_key, $redis_ttl, $call_usage);
        }

        return json_decode($call_usage, true);
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $transaction_type
     * @return mixed
     */
    public function getOutgoingUsage($customer_id, $from, $to, $transaction_type)
    {
        $redis_key = "outgoing_call:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$call_usage = Redis::get($redis_key)) {
            $response_data = $this->get($this->getCallUsageUrl($customer_id, $from, $to, $transaction_type));
            $data = $this->prepareOutgoingUsageHistory(json_decode($response_data['response']));

            $call_usage = json_encode($data);
            Redis::setex($redis_key, $redis_ttl, $call_usage);
        }

        return json_decode($call_usage, true);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCallUsageHistory($user, $from, $to)
    {
        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        $redis_key = "call_usage:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$call_usage = Redis::get($redis_key)) {
            $outgoing_usage = $this->getOutgoingUsage(
                $customer_id,
                $from,
                $to,
                self::OUTGOING_TRANSACTION_TYPE
            );

            $incoming_usage = $this->getIncomingUsage(
                substr($user->msisdn, 3),
                $from,
                $to,
                self::INCOMING_TRANSACTION_TYPE
            );

            $call_usage_data = array_merge($outgoing_usage, $incoming_usage);

            $formatted_data = $this->prepareCallUsageHistory($call_usage_data);

            $call_usage = json_encode($formatted_data);
            Redis::setex($redis_key, $redis_ttl, $call_usage);
        }

        return $this->responseFormatter->sendSuccessResponse(json_decode($call_usage, true), 'Call Usage History');
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareCallUsageHistory($data)
    {
        $collection = collect($data)->sortByDesc('date');

        return $collection->values()->all();
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareIncomingUsageHistory($data)
    {
        $incoming_data = [];
        if (!empty($data->data)) {
            foreach ($data->data as $usage_data) {
                $item = $usage_data->attributes;
                if ($item) {
                    $incoming_data [] = [
                        'date' => $this->checkValidDateFormat($item->eventAt) ?
                            Carbon::parse($item->eventAt)->setTimezone('UTC')->toDateTimeString() : null,
                        'number' => $item->callingNumber,
                        'is_outgoing' => false,
                        'duration' => $this->formatUnit($item->duration),
                        'duration_unit' => 'seconds',
                        'cost' => $this->formatCost(0),
                    ];
                }
            }
        }

        return $incoming_data;
    }

    /**
     * @param $data
     * @return array
     */
    public function prepareOutgoingUsageHistory($data)
    {
        $outgoing_data = [];
        if (!empty($data->data)) {
            foreach ($data->data as $usage_data) {
                $item = $usage_data->attributes;
                if ($item) {
                    $outgoing_data [] = [
                        'date' => $this->checkValidDateFormat($item->eventAt) ?
                            Carbon::parse($item->eventAt)->setTimezone('UTC')->toDateTimeString() : null,
                        'number' => $item->calledNumber,
                        'is_outgoing' => true,
                        'duration' => $this->formatUnit($item->duration),
                        'duration_unit' => 'seconds',
                        'cost' => $this->formatCost($item->transactionAmount)
                    ];
                }
            }
        }

        return $outgoing_data;
    }
}
