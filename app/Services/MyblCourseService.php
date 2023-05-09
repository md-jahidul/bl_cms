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
        // $builder = $builder->where('invoice_id', 1);
        $builder = $builder->latest();

        // $builder = $builder->whereHas(
        //     'details',
        //     function ($q) use ($request, $bundles) {
        //         if ($request->product_code) {
        //             $q->where('product_code', $request->product_code);
        //         }
        //         if ($request->sim_type) {
        //             $q->where('sim_type', $request->sim_type);
        //         }

        //         if ($request->content_type) {
        //             if (in_array($request->content_type, $bundles)) {
        //                 $q->where('content_type', $request->content_type);
        //                 $q->whereNull('call_rate');
        //             } elseif ($request->content_type == 'recharge_offer') {
        //                 $q->whereNotNull('recharge_product_code');
        //             } elseif ($request->content_type == 'scr') {
        //                 $q->whereNotNull('call_rate');
        //             } elseif ($request->content_type == 'free_products') {
        //                 $q->where('mrp_price', null);
        //             } elseif ($request->content_type == 'is_popular_pack') {
        //                 $q->where('is_popular_pack', 1);
        //             } else {
        //                 $q->where('content_type', $request->content_type);
        //             }
        //         }
        //     }
        // )->with('details');

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
                'invoice_id' => $item->invoice_id,
                'contact_no' => $item->contact_no,
                'sub_total' => $item->sub_total,
                'promo_code' => $item->promo_code,
                'total_promo_discount' => $item->total_promo_discount,
                'total_default_discount' => $item->total_default_discount,
                'order_total_price' => $item->order_total_price
            ];
        });
        return $response;
    }

}
