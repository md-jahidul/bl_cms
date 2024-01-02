<?php

namespace App\Services;

use App\Models\OnMobileTransactionStatus;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblTransactionStatusService
{
    use CrudTrait;

    public function getOnmobileTransaction($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new OnMobileTransactionStatus();

        $builder = $builder->latest();

        if ($request->from && $request->to) {
            $datefrom = $request->from . ' 00:00:00';
            $dateto = $request->to . ' 23:59:59';
            $builder = $builder->whereBetween('created_at', [$datefrom, $dateto]);
        }

        if ($request->ticket_id) {

            $builder = $builder->where('ticket_id', $request->ticket_id);
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
                'transaction_id' => $item->transaction_id,
                'createdAt' => $item->createdAt,
                'msisdn' => $item->msisdn,
                'status' => $item->status,
                'amount' => $item->amount,
                'subscriptionId' => $item->subscriptionId,
                'event' => $item->event,
                'date' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }

}
