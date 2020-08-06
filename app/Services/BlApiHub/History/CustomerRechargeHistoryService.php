<?php

namespace App\Services\BlApiHub\History;

use App\Enums\MyBlAppSettingsKey;
use App\Models\MyBlAppSettings;
use App\Repositories\CustomerRepository;
use App\Services\BlApiHub\ApiBaseService;
use App\Services\BlApiHub\BaseService;
use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerRechargeHistoryService
 * @package App\Services\BlApiHub\History
 */
class CustomerRechargeHistoryService extends BaseService
{
    /**
     * @var ApiBaseService
     */
    public $responseFormatter;
    protected const RECHARGE_USAGE_API_ENDPOINT = "/usages-history/recharge/recharge-history/getRechargeHistory";
    protected const TRANSACTION_TYPE = "recharge";
    /**
     * @var CustomerService
     */
    protected $customerService;

    public function __construct(ApiBaseService $apiBaseService, CustomerService $customerService)
    {
        $this->responseFormatter = $apiBaseService;
        $this->customerService = $customerService;
    }

    public function getRechargeHistoryUrl($customer_id, $from, $to, $transactionType)
    {
        return self::RECHARGE_USAGE_API_ENDPOINT . "?" .
            "from=$from&to=$to&subscriptionId=$customer_id&transactionType=$transactionType";
    }

    public function prepareRechargeHistoryData($customer_id, $from, $to, $transaction_type)
    {
        $response_data = $this->get($this->getRechargeHistoryUrl($customer_id, $from, $to, $transaction_type));

        $formatted_data = $this->prepareRechargeHistory(json_decode($response_data['response']));

        $formatted_data = collect($formatted_data)->sortByDesc('date')->values();
        return $formatted_data;
    }

    /**
     * @param $user
     * @param $from
     * @param $to
     * @return JsonResponse
     */
    public function getRechargeHistory($user, $from, $to)
    {
        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        $redis_key = "recharge_usage:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$recharge_usage = Redis::get($redis_key)) {
            $formatted_data = $this->prepareRechargeHistoryData(
                $customer_id,
                $from,
                $to,
                self::TRANSACTION_TYPE
            );

            $recharge_usage = json_encode($formatted_data);
            Redis::setex($redis_key, $redis_ttl, $recharge_usage);
        }

        return $this->responseFormatter->sendSuccessResponse(json_decode($recharge_usage, true), 'Recharge History');
    }

    public function prepareRechargeHistory($data)
    {
        $recharge_data = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                if ($item) {
                    $recharge_data [] = [
                        'date'          => Carbon::parse($item->eventAt)->setTimezone('UTC')->toDateTimeString(),
                        'recharge_from' => $item->msisdn,
                        'amount'        => $item->transactionAmount,
                    ];
                }
            }
        }

        return $recharge_data;
    }
}
