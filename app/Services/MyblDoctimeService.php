<?php

namespace App\Services;

use App\Models\TransactionStatusDoctime;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblDoctimeService
{
    use CrudTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getDoctimeTransaction(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new TransactionStatusDoctime();

        $builder = $builder->latest();

        if ($request->from && $request->to) {
            $datefrom = $request->from . ' 00:00:00';
            $dateto = $request->to . ' 23:59:59';
            $builder = $builder->whereBetween('created_at', [$datefrom, $dateto]);
        }

        if ($request->transaction_id) {
            
            $builder = $builder->where('transaction_id', $request->transaction_id);
        }

        $all_items_count = $builder->count();

        if ($length == -1 ) $length = $all_items_count;

        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'contact_no' => $item->contact_no,
                'service' => $item->service,
                'service_id' => $item->service_id,
                'amount' => $item->amount,
                'payment_status' => $item->payment_status,
                'transaction_time' => $item->transaction_time,
                'transaction_id' => $item->transaction_id,
                'remarks' => $item->remarks,
                'promo_code' => $item->promo_code,
                'date' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }

}
