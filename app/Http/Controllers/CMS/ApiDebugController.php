<?php

namespace App\Http\Controllers\CMS;

use App\Models\Customer;
use App\Services\BlApiHub\AuditLogsService;
use App\Services\BlApiHub\BalanceService;
use App\Services\BlApiHub\BonusLogsService;
use App\Services\BlApiHub\History\CustomerCallUsageService;
use App\Services\BlApiHub\History\CustomerInternetUsageService;
use App\Services\BlApiHub\History\CustomerRechargeHistoryService;
use App\Services\BlApiHub\History\CustomerRoamingUsageService;
use App\Services\BlApiHub\History\CustomerSmsUsageService;
use App\Services\BlApiHub\History\CustomerSubscriptionUsageService;
use App\Services\BlApiHub\History\CustomerSummaryUsageService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ApiDebugController
 * @package App\Http\Controllers\CMS\Debug
 */
class ApiDebugController extends Controller
{
    /**
     * ApiDebugController constructor.
     * @param  BalanceService  $balanceService
     * @param  AuditLogsService  $auditLogsService
     * @param  BonusLogsService  $bonusLogsService
     * @param  CustomerSummaryUsageService  $customerSummaryUsageService
     * @param  CustomerCallUsageService  $callUsageService
     * @param  CustomerInternetUsageService  $internetUsageService
     * @param  CustomerSmsUsageService  $smsUsageService
     * @param  CustomerRechargeHistoryService  $rechargeHistoryService
     * @param  CustomerRoamingUsageService  $roamingUsageService
     * @param  CustomerSubscriptionUsageService  $subscriptionUsageService
     */
    public function __construct(
        BalanceService $balanceService,
        AuditLogsService $auditLogsService,
        BonusLogsService $bonusLogsService,
        CustomerSummaryUsageService $customerSummaryUsageService,
        CustomerCallUsageService $callUsageService,
        CustomerInternetUsageService $internetUsageService,
        CustomerSmsUsageService $smsUsageService,
        CustomerRechargeHistoryService $rechargeHistoryService,
        CustomerRoamingUsageService $roamingUsageService,
        CustomerSubscriptionUsageService $subscriptionUsageService
    ) {
        $this->balanceService = $balanceService;
        $this->auditLogsService = $auditLogsService;
        $this->customerSummaryUsageService = $customerSummaryUsageService;
        $this->callUsageService = $callUsageService;
        $this->internetUsageService = $internetUsageService;
        $this->smsUsageService = $smsUsageService;
        $this->rechargeHistoryService = $rechargeHistoryService;
        $this->roamingUsageService = $roamingUsageService;
        $this->bonusLogsService = $bonusLogsService;
        $this->subscriptionUsageService = $subscriptionUsageService;
        $this->middleware(['auth', 'debugEntryCheck']);
    }

    /**
     * @return Application|Factory|View
     */
    public function userBalancePanel()
    {
        $current_date = Carbon::now()->toDateString();
        $last_date = Carbon::now()->subDays(9)->toDateString();
        return view('admin.debug.index', compact('current_date', 'last_date'));
    }

    /**
     * @param $numbner
     * @return mixed
     */
    public function getBalanceSummary($number)
    {
        $customer = Customer::where('phone', $number)->first();
        $summary = ($this->balanceService->getBalanceSummary($customer))->getData();
        //dd($summary);

        return view('admin.debug.__partials.balance-summary', compact('summary'))->render();
    }

    /**
     * @param $number
     * @param $type
     * @return array|string
     * @throws \Throwable
     */
    public function getBalanceDetails($number, $type)
    {
        $customer = Customer::where('phone', $number)->first();

        $details = ($this->balanceService->getBalanceDetails($type, $customer))->getData();

        $views = [
            'minutes' => 'admin.debug.__partials.minutes-details',
            'sms' => 'admin.debug.__partials.sms-details',
            'internet' => 'admin.debug.__partials.internet-details',
        ];

        return view($views [$type], compact('details'))->render();
    }

    /**
     * @param  Request  $request
     * @param $number
     */
    public function getBrowseHistory(Request $request, $number)
    {
        return $this->auditLogsService->getLogs($request, $number);
    }

    public function getLoginBonusHistory(Request $request, $number)
    {
        return $this->bonusLogsService->getLogs($request, $number);
    }

    public function getLastLogin($number)
    {
        $user = Customer::where('msisdn', '88' . $number)->first();
        if ($user) {
            return Carbon::parse($user->last_login_at)->format('Y-m-d g:i A');
        }
       // return $this->bonusLogsService->getLogs($request, $number);
    }

    /**
     * @param $number
     * @return array|string
     * @throws \Throwable
     */
    public function getUsageSummary($number)
    {
        $customer = Customer::where('phone', $number)->first();
        $from = Carbon::now()->subDays(9)->toDateString();
        $to = Carbon::now()->toDateString();

        $summary_usage = ($this->customerSummaryUsageService->getSummaryUsageHistory($customer, $from, $to))->getData();
        //dd($summary_usage);
        return view('admin.debug.__partials.usage-summary', compact('summary_usage'))->render();
    }

    public function getUsageDetails($number, $type)
    {
        $customer = Customer::where('phone', $number)->first();
        $from = Carbon::now()->subDays(9)->toDateString();
        $to = Carbon::now()->toDateString();

        $views = [
            'minutes' => 'admin.debug.__partials.usage-details.usage-minutes-details',
            'sms' => 'admin.debug.__partials.usage-details.usage-sms-details',
            'internet' => 'admin.debug.__partials.usage-details.usage-internet-details',
            'recharge' => 'admin.debug.__partials.usage-details.usage-recharge-details',
            'subscription' => 'admin.debug.__partials.usage-details.usage-subscription-details',
        ];

        if ($type == "internet") {
            $details = ($this->internetUsageService->getInternetUsageHistory($customer, $from, $to))->getData();
        }
        if ($type == "minutes") {
            $details = ($this->callUsageService->getCallUsageHistory($customer, $from, $to))->getData();
        }
        if ($type == "sms") {
            $details = ($this->smsUsageService->getSmsUsageHistory($customer, $from, $to))->getData();
        }
        if ($type == "recharge") {
            $details = ($this->rechargeHistoryService->getRechargeHistory($customer, $from, $to))->getData();
        }

        if ($type == "subscription") {
            $details = ($this->subscriptionUsageService->getSubscriptionUsageHistory($customer, $from, $to))->getData();
            //dd($details);
        }

        return view($views [$type], compact('details'))->render();
    }
}
