<?php

namespace App\Services;

use App\Models\MusicTransactionStatus;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblMusicService
{
    use CrudTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getMusicTransaction(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new MusicTransactionStatus();
        $builder = $builder->latest();
        if ($request->from && $request->to) {
            $datefrom = $request->from . ' 00:00:00';
            $dateto = $request->to . ' 23:59:59';
            $builder = $builder->whereBetween('created_at', [$datefrom, $dateto]);
        }

        if ($request->payment_id) {
            
            $builder = $builder->where('payment_id', $request->payment_id);
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
                'subscription_request_id' => $item->subscription_request_id,
                'action_type' => $item->action_type,
                'action_message' => $item->action_message,
                'payment_id' => $item->payment_id,
                'msisdn' => $item->msisdn,
                'service_id' => $item->service_id,
                'amount' => $item->amount,
                'date' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }

}
