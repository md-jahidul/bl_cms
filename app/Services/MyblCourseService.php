<?php

namespace App\Services;

use App\Models\CourseTransactionStatus;
use App\Repositories\CourseTransactionStatusRepository;
use App\Traits\CrudTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyblCourseService
{
    use CrudTrait;

    /**
     * @var CourseTransactionStatusRepository
     */
    private $courseTransactionStatusRepository;

    /**
     * MyblCourseService constructor.
     * @param CourseTransactionStatusRepository $courseTransactionStatusRepository
     */
    public function __construct(CourseTransactionStatusRepository $courseTransactionStatusRepository)
    {
        $this->courseTransactionStatusRepository = $courseTransactionStatusRepository;
        $this->setActionRepository($courseTransactionStatusRepository);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCourseTransaction(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new CourseTransactionStatus();
        $builder = $builder->latest();

        if ($request->from && $request->to) {
            $datefrom = $request->from . ' 00:00:00';
            $dateto = $request->to . ' 23:59:59';
            $builder = $builder->whereBetween('created_at', [$datefrom, $dateto]);
        }
        
        $builder = $builder->whereHas(
            'items',
            function ($q) use ($request) {
                if ($request->invoice_id) {
                    $q->where('invoice_id', $request->invoice_id);
                }
            }
        )->with('items:id,invoice_id,catalog_product_id,catalog_sku_id,actual_price,default_discount,final_price');

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
                'invoice_id' => $item->invoice_id,
                'contact_no' => $item->contact_no,
                'sub_total' => $item->sub_total,
                'promo_code' => $item->promo_code,
                'total_promo_discount' => $item->total_promo_discount,
                'total_default_discount' => $item->total_default_discount,
                'order_total_price' => $item->order_total_price,
                'items' => collect($item->items),
                'date' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });
        return $response;
    }

}
