<?php

namespace App\Http\Controllers\CMS;

use App\Models\Customer;
use App\Services\BlApiHub\BalanceService;
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
     */
    public function __construct(BalanceService $balanceService)
    {
        $this->balanceService = $balanceService;
        $this->middleware(['auth', 'debugEntryCheck']);
    }

    /**
     * @return Application|Factory|View
     */
    public function userBalancePanel()
    {
        //dd('oo');
        return view('admin.debug.index');
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
            'minutes'  => 'admin.debug.__partials.minutes-details',
            'sms'      => 'admin.debug.__partials.sms-details',
            'internet' => 'admin.debug.__partials.internet-details',
        ];

        return view($views [$type], compact('details'))->render();
    }

    /**
     * @param $number
     */
    public function getBrowseHistory($number)
    {

    }
}
