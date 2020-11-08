<?php

namespace App\Http\Controllers;

use App\Services\BalanceTransferService;
use Illuminate\Http\Request;

class BalanceTransferController extends Controller
{

    /**
     * @var BalanceTransferService
     */
    private $balanceTransferService;

    /**
     * BalanceTransferController constructor.
     * @param BalanceTransferService $balanceTransferService
     */
    public function __construct(BalanceTransferService $balanceTransferService)
    {
        $this->balanceTransferService = $balanceTransferService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPrefillAmounts()
    {
        $amounts = $this->balanceTransferService->amountList();
        if (!count($amounts)) {
            $amounts = ['', '', '', '', '', '', '', ''];
        }

        return view('admin.balance-transfer.prefill-amount.show', compact('amounts'));
    }

    public function storePrefillAmounts(Request $request)
    {
        if ($this->balanceTransferService->savePrefillAmounts($request->all())) {
            $message = ['type' => 'success', 'message' => 'Prefill Amounts Updated Successfully'];
        } else {
            $message = [
                'type' => 'error',
                'message' => 'Update failed. Please avoid inserting same amount more than once and try again'
            ];
        }
        return redirect()->back()->with($message['type'], $message['message']);
    }

    public function showTermsConditions()
    {

    }
}
