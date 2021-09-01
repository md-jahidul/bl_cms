<?php

namespace App\Services\BlApiHub;

use App\Models\Customer;
use App\Models\ProductCore;
use App\Services\CustomerService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BalanceService
 * @package App\Services\BlApiHub
 */
class BalanceService extends BaseService
{

    public $responseFormatter;
    protected const BALANCE_API_ENDPOINT = "/customer-information/customer-information";
    protected const MINIMUM_BALANCE_FOR_LOAN = 20;


    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @var ProductLoanService
     */

    protected $loanService;

    protected $subscriptionProductService;

    /**
     * BalanceService constructor.
     * @param  CustomerService  $customerService
     * @param  ProductLoanService  $productLoanService
     */
    public function __construct(
        CustomerService $customerService,
        ProductLoanService $productLoanService
    ) {
        $this->customerService = $customerService;
        $this->responseFormatter = new ApiBaseService();
        $this->loanService = $productLoanService;
    }

    /**
     * @param $customer_id
     * @return string
     */
    private function getPrepaidBalanceUrl($customer_id)
    {
        return self::BALANCE_API_ENDPOINT . '/' . $customer_id . '/prepaid-balances' . '?sortType=SERVICE_TYPE';
    }

    /**
     * @param $customer_id
     * @return string
     */
    private function getPostpaidBalanceUrl($customer_id)
    {
        return self::BALANCE_API_ENDPOINT . '/' . $customer_id . '/postpaid-info';
    }

    /**
     * @param $balance
     * @return bool
     * @throws \Exception
     */
    private function isEligibleToLoan($balance)
    {
        return random_int(0, 1) && $balance < self::MINIMUM_BALANCE_FOR_LOAN;
    }

    /**
     * @param $customer_id
     * @return JsonResponse
     */
    public function getPrepaidBalance($customer_id)
    {
        $response = $this->get($this->getPrepaidBalanceUrl($customer_id));
        $response = json_decode($response['response']);

        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                'Currently Service Unavailable. Please,try again later',
                [
                    'message' => 'Currently Service Unavailable. Please,try again later',
                ],
                500
            );
        }

        $balance_data = collect($response->money);

        $main_balance = $balance_data->first(function ($item) {
            return $item->type == 'MAIN';
        });

        return  isset($main_balance->amount) ? $main_balance->amount : 0;
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getPostpaidBalance($customer_id)
    {
        $response = $this->get($this->getPostpaidBalanceUrl($customer_id));
        $response = json_decode($response['response']);

        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                'Currently Service Unavailable. Please,try again later',
                [
                    'message' => 'Currently Service Unavailable. Please,try again later',
                ],
                500
            );
        }

        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();

        return ($local_balance->creditLimit - $local_balance->totalOutstanding);
    }

    /**
     * @param $response
     * @param $customer_id
     * @return mixed
     */
    private function preparePrepaidBalanceSummary($response, $customer_id)
    {
        $balance_data = collect($response->money);
        //dd($balance_data);
        $main_balance = $balance_data->first(function ($item) {
            return $item->type == 'MAIN';
        });

        $data ['connection_type'] = 'PREPAID';

        $data['balance'] = [
            'amount' => isset($main_balance->amount) ? $main_balance->amount : 0,
            'unit' => isset($main_balance->unit) ? $main_balance->unit : 'Tk.',
            'expires_in' => isset($main_balance->expiryDateTime) ?
                Carbon::parse($main_balance->expiryDateTime)->setTimezone('UTC')->toDateTimeString() : null,
            'loan' => $this->loanService->hasMALoan($customer_id)
        ];


        $talk_time = collect($response->voice);

        if ($talk_time) {
            $total_remaining_talk_time = $talk_time->sum('amount');
            $total_talk_time = $talk_time->sum('totalAmount');
            $data['minutes'] = [
                'total' => $total_talk_time,
                'remaining' => $total_remaining_talk_time,
                'unit' => 'MIN'
            ];
        }

        $sms = collect($response->sms);

        if ($sms) {
            $total_remaining_sms = $sms->sum('amount');
            $total_sms = $sms->sum('totalAmount');
            $data['sms'] = [
                'total' => $total_sms,
                'remaining' => $total_remaining_sms,
                'unit' => 'SMS'
            ];
        }


        $internet = collect($response->data);

        if ($internet) {
            $total_remaining_internet = $internet->sum('amount');
            $total_internet = $internet->sum('totalAmount');
            $data['internet'] = [
                'total' => $total_internet,
                'remaining' => $total_remaining_internet,
                'unit' => 'MB'
            ];
        }

        return $this->responseFormatter->sendSuccessResponse($data, 'User Balance Summary');
    }


    /**
     * @param  Customer  $user
     * @return JsonResponse
     */
    public function getBalanceSummary($user)
    {

        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        $customer_type = Customer::connectionType(Customer::find($user->id));

        if ($customer_type == 'PREPAID') {
            return $this->getPrepaidSummary($customer_id);
        }

        if ($customer_type == 'POSTPAID') {
            return $this->getPostpaidSummary($customer_id);
        }
    }


    /**
     * @param $customer_id
     * @return mixed
     */
    private function getPrepaidSummary($customer_id)
    {
        $response = $this->get($this->getPrepaidBalanceUrl($customer_id));

        $response = json_decode($response['response']);

        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                $response->message,
                [],
                $response->status
            );
        }

        return $this->preparePrepaidBalanceSummary($response, $customer_id);
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    private function getPostpaidSummary($customer_id)
    {
        $response = $this->get($this->getPostpaidBalanceUrl($customer_id));
        $response = json_decode($response['response']);

        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                $response->message,
                [],
                $response->status
            );
        }

        return $this->preparePostpaidSummary($response);
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getInternetBalance($response)
    {
        $internet_data = collect($response->data);

        $internet = $internet_data->filter(function ($item) {
            return $item->serviceType == 'DATA';
        });

        $data = [];
        foreach ($internet as $item) {
            $data [] = [
                'package_name' => isset($item->product->name) ? $item->product->name : null,
                'total' => $item->totalAmount,
                'remaining' => $item->amount,
                'unit' => $item->unit,
                'expires_in' => Carbon::parse($item->expiryDateTime)->setTimezone('UTC')->toDateTimeString(),
                'auto_renew' => false
            ];
        }

        return $this->responseFormatter->sendSuccessResponse($data, 'Internet  Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getPostpaidInternetBalance($response)
    {
        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();
        $usage = collect($local_balance->productUsage)->where('code', '<>', '');
        $data = [];
        foreach ($usage as $product) {
            foreach ($product->usages as $item) {
                $type = $item->serviceType;
                if ($type == 'DATA') {
                    $sms = [
                        'package_name' => isset($product->name) ? $product->name : null,
                        'total' => $item->total,
                        'remaining' => $item->left,
                        'unit' => $item->unit,
                        'expires_in' => Carbon::parse($product->deactivatedAt)->setTimezone('UTC')->toDateTimeString(),
                        'auto_renew' => false
                    ];
                    $data [] = $sms;
                }
            }
        }
        return $this->responseFormatter->sendSuccessResponse($data, 'DATA  Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getSmsBalance($response)
    {
        $sms = collect($response->sms);
        $data = [];
        foreach ($sms as $item) {
            $data [] = [
                'package_name' => isset($item->product->name) ? $item->product->name : null,
                'total' => $item->totalAmount,
                'remaining' => $item->amount,
                'unit' => $item->unit,
                'expires_in' => Carbon::parse($item->expiryDateTime)->setTimezone('UTC')->toDateTimeString(),
                'auto_renew' => false
            ];
        }

        return $this->responseFormatter->sendSuccessResponse($data, 'SMS  Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getPostpaidSmsBalance($response)
    {
        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();
        $usage = collect($local_balance->productUsage)->where('code', '<>', '');
        $data = [];
        foreach ($usage as $product) {
            foreach ($product->usages as $item) {
                $type = $item->serviceType;
                if ($type == 'SMS') {
                    $sms = [
                        'package_name' => isset($product->name) ? $product->name : null,
                        'total' => $item->total,
                        'remaining' => $item->left,
                        'unit' => $item->unit,
                        'expires_in' => Carbon::parse($product->deactivatedAt)->setTimezone('UTC')->toDateTimeString(),
                        'auto_renew' => false
                    ];
                    $data [] = $sms;
                }
            }
        }
        return $this->responseFormatter->sendSuccessResponse($data, 'SMS  Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getTalkTimeBalance($response)
    {
        $talk_time = collect($response->voice);

        $data = [];
        foreach ($talk_time as $item) {
            $data [] = [
                'package_name' => isset($item->product->name) ? $item->product->name : null,
                'total' => $item->totalAmount,
                'remaining' => $item->amount,
                'unit' => $item->unit,
                'expires_in' => Carbon::parse($item->expiryDateTime)->setTimezone('UTC')->toDateTimeString(),
                'auto_renew' => false
            ];
        }

        return $this->responseFormatter->sendSuccessResponse($data, 'Talk Time  Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getPostpaidTalkTimeBalance($response)
    {
        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();
        $usage = collect($local_balance->productUsage)->where('code', '<>', '');
        $data = [];
        foreach ($usage as $product) {
            foreach ($product->usages as $item) {
                $type = $item->serviceType;
                if ($type == 'VOICE') {
                    $minutes = [
                        'package_name' => isset($product->name) ? $product->name : null,
                        'total' => $item->total,
                        'remaining' => $item->left,
                        'unit' => $item->unit,
                        'expires_in' => Carbon::parse($product->deactivatedAt)->setTimezone('UTC')->toDateTimeString(),
                        'auto_renew' => false
                    ];
                    $data [] = $minutes;
                }
            }
        }
        return $this->responseFormatter->sendSuccessResponse($data, 'Talk Time  Balance Details');
    }

    /**
     * @param $response
     * @param $customer
     * @return mixed
     */
    private function getMainBalance($response, $customer)
    {
        $balance_data = collect($response->money);

        $main_balance = $balance_data->first(function ($item) {
            return $item->type == 'MAIN';
        });

        //$customer_id = $customer->customer_account_id;

/*        $subscription_products = $this->subscriptionProductService->getSubscriptionProducts($customer_id);

        $rate_cutter_offer = collect($subscription_products)->first(function ($item) {
            return substr($item['code'], -3) == 'SEC';
        });*/

        $rate_cutter_info = null;
/*
        if ($rate_cutter_offer) {
            $product = ProductCore::where('product_code', $rate_cutter_offer ['code'])->first();
            if ($product) {
                $rate_cutter_info = [
                    'title' => $rate_cutter_offer ['commercialName'],
                    'code'  => $rate_cutter_offer ['code'],
                    'fee'   => $rate_cutter_offer ['fee'],
                    'rate_cutter_rate' => $product->call_rate,
                    'rate_cutter_rate_unit' => $product->call_rate_unit,
                    'expires_in' => isset($rate_cutter_offer['deactivatedDateTime']) ?
                        Carbon::parse($rate_cutter_offer['deactivatedDateTime'])->setTimezone('UTC')
                            ->toDateTimeString() : null
                ];
            }
        }*/

        $data = [
            'connection_type' => 'PREPAID',
            'remaining_balance' => [
                'amount' => isset($main_balance->amount) ? $main_balance->amount : 0,
                'currency' => 'Tk.',
                'expires_in' => isset($main_balance->expiryDateTime) ?
                    Carbon::parse($main_balance->expiryDateTime)->setTimezone('UTC')->toDateTimeString() : null
            ],
            'roaming_balance' => [
                'amount' => 0,
                'currency' => 'USD',
                'expires_in' => null
            ],

            'rate_cutter' => $rate_cutter_info
        ];


        return $this->responseFormatter->sendSuccessResponse($data, 'Main Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function getPostpaidMainBalance($response)
    {
        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();
        $local = [
            'total_outstanding' => $local_balance->totalOutstanding,
            'credit_limit' => $local_balance->creditLimit
        ];

        $roaming_balance = collect($response)->where('billingAccountType', '=', 'ROAMING')->first();
        $roaming = [
            'total_outstanding' => $roaming_balance->totalOutstanding,
            'credit_limit' => $roaming_balance->creditLimit
        ];

        $data = [
            'connection_type' => 'POSTPAID',
            'local_balance' => $local,
            'roaming_balance' => $roaming
        ];

        return $this->responseFormatter->sendSuccessResponse($data, 'Main Balance Details');
    }

    /**
     * @param $type
     * @param $response
     * @param $customer
     * @return mixed
     */
    private function getPrepaidDetails($type, $response, $customer)
    {
        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                $response->message,
                [],
                $response->status
            );
        }

        if ($type == 'internet') {
            return $this->getInternetBalance($response);
        } elseif ($type == 'sms') {
            return $this->getSmsBalance($response);
        } elseif ($type == 'minutes') {
            return $this->getTalkTimeBalance($response);
        } elseif ($type == 'balance') {
            return $this->getMainBalance($response, $customer);
        } else {
            return $this->responseFormatter->sendErrorResponse(
                "Type Not Supported",
                [
                    'Type Not Supported'
                ],
                404
            );
        }
    }

    /**
     * @param $type
     * @param $response
     * @return mixed
     */
    private function getPostpaidDetails($type, $response)
    {
        if (isset($response->error)) {
            return $this->responseFormatter->sendErrorResponse(
                $response->message,
                [],
                $response->status
            );
        }

        if ($type == 'internet') {
            return $this->getPostpaidInternetBalance($response);
        } elseif ($type == 'sms') {
            return $this->getPostpaidSmsBalance($response);
        } elseif ($type == 'minutes') {
            return $this->getPostpaidTalkTimeBalance($response);
        } elseif ($type == 'balance') {
            return $this->getPostpaidMainBalance($response);
        } else {
            return $this->responseFormatter->sendErrorResponse(
                "Type Not Supported",
                [],
                404
            );
        }
    }

    /**
     * @param $type
     * @param  Customer  $user
     * @return mixed
     */
    public function getBalanceDetails($type, $user)
    {

        if (!$user) {
            return $this->responseFormatter->sendErrorResponse("User not found", [
                'message' => "MSISDN NOT FOUND!"
            ], 404);
        }

        $customer_id = $user->customer_account_id;

        $customer_type = Customer::connectionType(Customer::find($user->id));

        if ($customer_type == 'PREPAID') {
            $response = $this->get($this->getPrepaidBalanceUrl($customer_id));
            $response = json_decode($response['response']);
            return $this->getPrepaidDetails($type, $response, $user);
        }

        if ($customer_type == 'POSTPAID') {
            $response = $this->get($this->getPostpaidBalanceUrl($customer_id));
            $response = json_decode($response['response']);
            return $this->getPostpaidDetails($type, $response);
        }

        return $this->responseFormatter->sendSuccessResponse([], 'User Balance Details');
    }

    /**
     * @param $response
     * @return mixed
     */
    private function preparePostpaidSummary($response)
    {
        $local_balance = collect($response)->where('billingAccountType', '=', 'LOCAL')->first();
        $balance = [
            'total_outstanding' => $local_balance->totalOutstanding,
            'credit_limit' => $local_balance->creditLimit,
            'payment_date' => isset($local_balance->nextPaymentDate) ?
                Carbon::parse($local_balance->nextPaymentDate)->setTimezone('UTC')->toDateTimeString() : null,
        ];

        $usage = collect($local_balance->productUsage)->where('code', '<>', '');

        $minutes = [];
        $sms = [];
        $internet = [];

        foreach ($usage as $product) {
            foreach ($product->usages as $item) {
                $type = $item->serviceType;
                switch ($type) {
                    case "DATA":
                        $internet ['total'][] = $item->total;
                        $internet ['remaining'][] = $item->left;
                        break;
                    case "VOICE":
                        $minutes ['total'][] = $item->total;
                        $minutes ['remaining'][] = $item->left;
                        break;
                    case "SMS":
                        $sms ['total'][] = $item->total;
                        $sms ['remaining'][] = $item->left;
                        break;
                }
            }
        }

        $data ['connection_type'] = 'POSTPAID';
        $data ['balance'] = $balance;
        $data ['minutes'] = [
            'total' => isset($minutes['total']) ? array_sum($minutes['total']) : 0,
            'remaining' => isset($minutes['remaining']) ? array_sum($minutes['remaining']) : 0,
            'unit' => 'MIN'
        ];
        $data ['internet'] = [
            'total' => isset($internet['total']) ? array_sum($internet['total']) : 0,
            'remaining' => isset($internet['remaining']) ? array_sum($internet['remaining']) : 0,
            'unit' => 'MB'
        ];
        $data ['sms'] = [
            'total' => isset($sms['total']) ? array_sum($sms['total']) : 0,
            'remaining' => isset($sms['remaining']) ? array_sum($sms['remaining']) : 0,
            'unit' => 'SMS'
        ];

        return $this->responseFormatter->sendSuccessResponse($data, 'User Balance Summary');
    }
}
