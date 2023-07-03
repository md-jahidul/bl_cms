<?php

namespace App\Services;

use App\Models\BusTransactionStatus;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblTransactionStatusService
{
    use CrudTrait;

    public function getBusTransaction($request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new BusTransactionStatus();

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
                'ticket_id' => $item->ticket_id,
                'ticket_no' => $item->ticket_no,
                'from_station' => $item->from_station,
                'to_station' => $item->to_station,
                'date' => $item->date,
                'time' => $item->time,
                'bus_name' => $item->bus_name,
                'amount' => $item->amount,
                'passenger_name' => $item->passenger_name,
                'passenger_email' => $item->passenger_email,
                'passenger_mobile' => $item->passenger_mobile,
                'booked_at' => $item->booked_at,
                'confirmed_at' => $item->confirmed_at,
                'cancelled_at' => $item->cancelled_at,
                'expiry_time' => $item->expiry_time,
            ];
        });
        return $response;
    }

}
