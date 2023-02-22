<?php

namespace App\Http\Controllers\CMS;

use App\Models\Customer;
use App\Models\MasterLog;
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
use App\Services\BlApiHub\OtpRequestLogsService;
use App\Services\ContactRestoreLogService;
use App\Services\HeaderEnrichmentLogsService;
use App\Services\NonBlNumberLogService;
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
     * @var ContactRestoreLogService
     */
    protected $contactRestoreLogService;

    /**
     * ApiDebugController constructor.
     * @param BalanceService $balanceService
     * @param AuditLogsService $auditLogsService
     * @param BonusLogsService $bonusLogsService
     * @param CustomerSummaryUsageService $customerSummaryUsageService
     * @param CustomerCallUsageService $callUsageService
     * @param CustomerInternetUsageService $internetUsageService
     * @param CustomerSmsUsageService $smsUsageService
     * @param CustomerRechargeHistoryService $rechargeHistoryService
     * @param CustomerRoamingUsageService $roamingUsageService
     * @param CustomerSubscriptionUsageService $subscriptionUsageService
     * @param OtpRequestLogsService $otpRequestLogsService
     * @param ContactRestoreLogService $contactRestoreLogService
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
        CustomerSubscriptionUsageService $subscriptionUsageService,
        OtpRequestLogsService $otpRequestLogsService,
        ContactRestoreLogService $contactRestoreLogService,
        HeaderEnrichmentLogsService $headerEnrichmentLogsService
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
        $this->otpRequestLogsService = $otpRequestLogsService;
        $this->middleware(['auth', 'debugEntryCheck']);
        $this->contactRestoreLogService = $contactRestoreLogService;
        $this->headerEnrichmentLogsService = $headerEnrichmentLogsService;
    }

    /**
     * @return Application|Factory|View
     */
    public function userBalancePanel()
    {
        $current_date = Carbon::now()->toDateString();
        $last_date = Carbon::now()->subDays(9)->toDateString();

        $date_limit = Carbon::now()->subDays(59)->toDateString();

        return view('admin.debug.index', compact('current_date', 'last_date', 'date_limit'));
    }

    /**
     * @param $number
     * @return mixed
     * @throws \Throwable
     */
    public function getBalanceSummary($number)
    {
        $customer = Customer::where('phone', $number)->first();
        $summary = ($this->balanceService->getBalanceSummary($customer))->getData();

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
     * @param Request $request
     * @param $number
     */
    public function getBrowseHistory(Request $request, $number)
    {
        return $this->auditLogsService->getLogs($request, $number);
    }

    /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getLoginBonusHistory(Request $request, $number)
    {
        return $this->bonusLogsService->getLogs($request, $number);
    }


    /**
     * @param $number
     * @return string
     */
    public function getLastLogin($number)
    {
        $user = Customer::where('msisdn', '88' . $number)->first();
        if ($user && $user->last_login_at) {
            return Carbon::parse($user->last_login_at)->format('Y-m-d g:i A');
        } else {
            return 'No Data Available';
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

    /**
     * @param $number
     * @param $type
     * @return array|string
     * @throws \Throwable
     */
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

    /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getOtpRequestLogs(Request $request, $number)
    {
        return $this->otpRequestLogsService->getLogs($request, $number);
    }

    /**
     * @param  Request  $request
     * @param $number
     * @return array
     */
    public function getOtpLoginRequestLogs(Request $request, $number)
    {
        return $this->otpRequestLogsService->getOtpLoginLogs($request, $number);
    }


     /**
     * @param Request $request
     * @param $number
     * @return array
     */
    public function getContactRestoreLogs(Request $request, $number)
    {
        return $this->contactRestoreLogService->getLogs($request, $number);
    }


    public function getProductLogs(Request $request, $number)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $today =Carbon::now()->toDateString(); //$request->date ? $request->date : Carbon::now()->toDateString();
        if ($request->date != '') {
            $date=explode('=',$request->date);
            $start_date=Carbon::parse($date[0])->format('Y-m-d').' 00:00:00';
            $end_date=Carbon::parse($date[1])->format('Y-m-d').' 23:59:59';

        }

        $items = MasterLog::where('msisdn', $number)->where('log_type', 'PRODUCT-PURCHASE');
        if ($request->date != '') {
            $items->whereBetween('created_at', [$start_date, $end_date]);
        }else{
            $items->whereBetween('created_at', [$today . '  00:00:00', $today . '  23:59:59']);
        }

        $items=$items->orderBy('created_at', 'DESC')->get();
        $all_items_count = count($items);
        $items = MasterLog::where('msisdn', $number);
        $items->where('log_type', 'PRODUCT-PURCHASE');

        if ($request->date != '') {
            $items->whereBetween('created_at', [$start_date, $end_date]);
        }else{
            $items->whereBetween('created_at', [$today . '  00:00:00', $today . '  23:59:59']);
        }
        $items->orderBy('created_at', 'DESC')->skip($start)->take($length)->get();


        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'date' => Carbon::parse($item->created_at)->toDateTimeString(),
                'msisdn' => $item->msisdn,
                'message' => $item->message,
                'balance' => $item->data,
                'others' => $item->others,
                'status' => $item->status,
            ];
        });
        return $response;
    }
}
