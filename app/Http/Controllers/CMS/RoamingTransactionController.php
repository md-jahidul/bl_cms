<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Jobs\FreeProductDisburseJob;
use App\Jobs\RoamingPaymentProcess;
use App\Models\RoamingTransaction;
use Illuminate\Http\Request;

class RoamingTransactionController extends Controller
{
    public function index()
    {
        return view('admin.roaming.transactions.index');
    }

    public function getRoamingTransactions(Request $request): array
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new RoamingTransaction();
        $builder = $builder->latest();

        if ($request->transaction_type != null) {
            $builder = $builder->where('transaction_type', $request->transaction_type);
        }

        if ($request->status != null) {
            $builder = $builder->where('status', $request->status);
        }

        if ($request->msisdn != null) {
            $builder = $builder->where('msisdn', '=', $request->msisdn);
        }

        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => $items->toArray(),
        ];
    }

    public function dispatchRoamingPaymentJob($transaction_id): array
    {
        RoamingPaymentProcess::dispatch($transaction_id);

        return [
            "status_code" => 200
        ];
    }
}
