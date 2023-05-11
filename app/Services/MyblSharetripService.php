<?php

namespace App\Services;

use App\Models\SharetripTransactionStatus;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblSharetripService
{
    use CrudTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getSharetripTransaction(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new SharetripTransactionStatus();
        $builder = $builder->latest();

        if ($request->booking_code) {
            
            $builder = $builder->where('booking_code', $request->booking_code);
        }

        $all_items_count = $builder->count();
        $items = $builder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'msisdn' => $item->msisdn,
                'pnr_code' => $item->pnr_code,
                'booking_code' => $item->booking_code,
                'booking_status' => $item->booking_status,
                'payment_status' => $item->payment_status,
                'amount' => $item->amount,
                'createdAt' => $item->createdAt,
            ];
        });
        return $response;
    }

}
