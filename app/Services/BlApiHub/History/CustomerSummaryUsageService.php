<?php

namespace App\Services\BlApiHub\History;

use App\Enums\MyBlAppSettingsKey;
use App\Models\MyBlAppSettings;
use App\Services\BlApiHub\ApiBaseService;
use App\Services\BlApiHub\BaseService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class CustomerSummaryUsageService
 * @package App\Services\BlApiHub\History
 */
class CustomerSummaryUsageService extends BaseService
{
    protected $subscriptionUsageService;

    public function __construct(
        ApiBaseService $apiBaseService,
        CustomerService $customerService,
        CustomerCallUsageService $callUsageService,
        CustomerSmsUsageService $smsUsageService,
        CustomerInternetUsageService $internetUsageService,
        CustomerRoamingUsageService $roamingUsageService,
        CustomerRechargeHistoryService $rechargeHistoryService,
        CustomerSubscriptionUsageService $subscriptionUsageService
    ) {
        $this->responseFormatter = $apiBaseService;
        $this->customerService = $customerService;
        $this->callUsageService = $callUsageService;
        $this->smsUsageService = $smsUsageService;
        $this->internetUsageService = $internetUsageService;
        $this->roamingUsageService = $roamingUsageService;
        $this->rechargeHistoryService = $rechargeHistoryService;
        $this->subscriptionUsageService = $subscriptionUsageService;
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @param $subscription_id_incoming
     * @return array|mixed
     */
    public function prepareSummaryUsageHistory($customer_id, $from, $to, $subscription_id_incoming)
    {
        $redis_key = "summary_usage:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$summary_usage = Redis::get($redis_key)) {
            $outgoing_call_usage_data = $this->callUsageService->getOutgoingUsage(
                $customer_id,
                $from,
                $to,
                'outgoing_calls'
            );
            $outgoing_call_usage_cost = collect($outgoing_call_usage_data)->sum('cost');
            $outgoing_total_call_usage = collect($outgoing_call_usage_data)->sum('duration');

            $incoming_call_usage_data = $this->callUsageService->getOutgoingUsage(
                $subscription_id_incoming,
                $from,
                $to,
                'incoming_calls'
            );
            $incoming_call_usage_cost = collect($incoming_call_usage_data)->sum('cost');
            $incoming_total_call_usage = collect($incoming_call_usage_data)->sum('duration');

            $sms_usage_data = $this->smsUsageService->getOutgoingSmsUsageData($customer_id, $from, $to, 'sms');
            $sms_usage_cost = collect($sms_usage_data)->sum('cost');
            $total_sms_usage = collect($sms_usage_data)->sum('usage');

            $incoming_sms_usage_data = $this->smsUsageService->getIncomingSmsUsageData(
                $subscription_id_incoming,
                $from,
                $to,
                'incoming_sms'
            );
            $incoming_sms_usage_cost = collect($incoming_sms_usage_data)->sum('cost');
            $incoming_total_sms_usage = collect($incoming_sms_usage_data)->sum('usage');

            $internet_usage_data = $this->internetUsageService->getInternetUsageData(
                $customer_id,
                $from,
                $to,
                'data_usage'
            );

            $internet_usage_cost = collect($internet_usage_data)->sum('cost');
            $total_internet_usage = collect($internet_usage_data)->sum('usage');

            $roaming_usage_data = $this->roamingUsageService->prepareSummaryUsageData($customer_id, $from, $to);
            $roaming_usage_cost = collect($roaming_usage_data)->sum();

            $recharge_usage_data = $this->rechargeHistoryService->prepareRechargeHistoryData(
                $customer_id,
                $from,
                $to,
                'recharge'
            );

            $recharge_usage_cost = collect($recharge_usage_data)->sum('amount');

            $subscription_usage_data = $this->subscriptionUsageService->getSummary($customer_id, $from, $to);

            $minutes = [
                'title' => 'Minutes',
                'total' => round(($outgoing_total_call_usage + $incoming_total_call_usage), 2),
                'unit' => 'Min',
                'cost' => round(($outgoing_call_usage_cost + $incoming_call_usage_cost), 2),
                'message' => 'Your minute usage in total'
            ];

            $internet = [
                'title' => 'Internet',
                'total' => $total_internet_usage,
                'unit' => 'mb',
                'cost' => round($internet_usage_cost, 2),
                'message' => 'Your data usage in total'
            ];

            $sms = [
                'title' => 'SMS',
                'total' => $total_sms_usage + $incoming_total_sms_usage,
                'unit' => 'SMS',
                'cost' => round(($sms_usage_cost + $incoming_sms_usage_cost), 2),
                'message' => 'Your SMS usage in total'
            ];

            $roaming = [
                'title' => 'Roaming',
                'total' => $roaming_usage_cost,
                'unit' => 'USD',
                'cost' => round($roaming_usage_cost, 2),
                'message' => 'Your roaming usage in total'
            ];

            $recharge = [
                'title' => 'Recharge',
                'total' => $recharge_usage_cost,
                'unit' => 'TK',
                'cost' => round($recharge_usage_cost, 2),
                'message' => 'Your recharge amount in total'
            ];

            $vas = [
                'title' => 'Subscriptions',
                'total' => $subscription_usage_data['active_count'],
                'unit' => '',
                'cost' => round($subscription_usage_data['cost'], 2),
                'message' => 'Your Subscription price in total'
            ];

            $summary =  [
                'total' =>  round($minutes['cost'] /*+ $internet['cost']*/ +
                                  $sms['cost'] + $roaming['cost'] + $vas ['cost'], 2),
                'minutes' => $minutes,
                'sms' => $sms,
                'roaming' => $roaming,
                'recharge' => $recharge,
                'vas' => $vas,
                'internet' => $internet

            ];

            Redis::setex($redis_key, $redis_ttl, json_encode($summary));

            return $summary;
        }


        return json_decode($summary_usage, true);
    }

    /**
     * @param $customer_id
     * @param $from
     * @param $to
     * @return array
     */
    public function prepareTotalUsageAmount($customer_id, $from, $to)
    {
        $redis_key = "total_usage_amount:" . $customer_id . ':' . $from . '-' . $to;
        $ttl_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::USAGE_HISTORY_TTL_SECONDS)->first();

        $redis_ttl = 300;

        if ($ttl_settings) {
            $redis_ttl = json_decode($ttl_settings->value)->value;
        }

        if (!$total_usage_cost = Redis::get($redis_key)) {
            $outgoing_call_usage_data = $this->callUsageService->getOutgoingUsage(
                $customer_id,
                $from,
                $to,
                'outgoing_calls'
            );
            $outgoing_call_usage_cost = collect($outgoing_call_usage_data)->sum('cost');

            $sms_usage_data = $this->smsUsageService->getOutgoingSmsUsageData($customer_id, $from, $to, 'sms');
            $sms_usage_cost = collect($sms_usage_data)->sum('cost');

            /*        $internet_usage_data = $this->internetUsageService->getInternetUsageData(
                        $customer_id,
                        $from,
                        $to,
                        'data_usage'
                    );

                    $internet_usage_cost = collect($internet_usage_data)->sum('cost');*/

            $roaming_usage_data = $this->roamingUsageService->prepareSummaryUsageData($customer_id, $from, $to);
            $roaming_usage_cost = $roaming_usage_data['minutes'] + $roaming_usage_data['sms'];

            $subscription_usage_data = $this->subscriptionUsageService->getSummary($customer_id, $from, $to);

            $total_usage_cost = $outgoing_call_usage_cost
                + $sms_usage_cost + $roaming_usage_cost + $subscription_usage_data['cost'];

            Redis::setex($redis_key, $redis_ttl, $total_usage_cost);
        }
        return [
            'total' => round($total_usage_cost, 2)
        ];
    }

    /**
     * @param $user
     * @param $from
     * @param $to
     * @param  bool  $content_for
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSummaryUsageHistory($user, $from, $to, $content_for = false)
    {
        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        if ($content_for == 'home') {
            $data = $this->prepareTotalUsageAmount($customer_id, $from, $to);
            return $this->responseFormatter->sendSuccessResponse($data, 'Usage Summary Total Amount');
        }

        $data = $this->prepareSummaryUsageHistory($customer_id, $from, $to, substr($user->msisdn, 3));

        return $this->responseFormatter->sendSuccessResponse($data, 'Usage Summary Data');
    }
}
