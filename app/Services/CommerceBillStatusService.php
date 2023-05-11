<?php

namespace App\Services;

use App\Models\CommerceBillStatus;
use App\Repositories\CommerceBillStatusRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class CommerceBillStatusService
{
    use CrudTrait;
    private $commerceBillStatusRepository;

    public function __construct(CommerceBillStatusRepository $commerceBillStatusRepository)
    {
        $this->commerceBillStatusRepository = $commerceBillStatusRepository;
        $this->setActionRepository($commerceBillStatusRepository);
    }

    // public function getPaginatedBills()
    // {
    //     $orderBy = ['column' => 'created_at', 'direction' => 'DESC'];
    //     return $this->commerceBillStatusRepository->findAll(30, null, $orderBy);
    // }

        /**
     * @param Request $request
     * @return array
     */
    public function getCommerceTransaction(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new CommerceBillStatus();
        $builder = $builder->latest();

        if ($request->bill_payment_id) {
            $builder = $builder->where('bill_payment_id', $request->bill_payment_id);
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
                'result' => $item->result,
                'message' => $item->message,
                'bill_payment_id' => $item->bill_payment_id,
                'bill_refer_id' => $item->bill_refer_id,
                'bllr_id' => $item->bllr_id,
                'bill_name' => $item->bill_name,
                'bill_no' => $item->bill_no,
                'biller_acc_no' => $item->biller_acc_no,
                'biller_mobile' => $item->biller_mobile,
                'bill_from' => $item->bill_from,
                'bill_to' => $item->bill_to,
                'bill_gen_date' => $item->bill_gen_date,
                'bill_due_date' => $item->bill_due_date,
                'charge' => $item->charge,
                'bill_total_amount' => $item->bill_total_amount,
                'transaction_id' => $item->transaction_id,
                'payment_date' => $item->payment_date,
                'payment_status' => $item->payment_status,
                'payment_amount' => $item->payment_amount,
                'payment_trx_id' => $item->payment_trx_id,
                'payment_method' => $item->payment_method,
            ];
        });
        return $response;
    }
}
