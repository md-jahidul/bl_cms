<?php

namespace App\Http\Controllers\CMS\Debug;

use App\Models\Customer;
use App\Services\BlApiHub\BalanceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userBalancePanel()
    {
        return view('admin.debug.index');
    }

    /**
     * @param $numbner
     * @return mixed
     */
    public function getPrepaidSummary($numbner)
    {
        $customer = Customer::where('phone', $numbner)->first();
        return $this->balanceService->getBalanceSummary($customer);
    }
}
