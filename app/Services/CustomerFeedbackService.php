<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Models\CustomerFeedback;
use App\Repositories\CustomerFeedbackRepository;
use App\Traits\CrudTrait;

class CustomerFeedbackService
{

    use CrudTrait;

    /**
     * @var $feedRepo
     */
    protected $feedRepo;

    /**
     * CustomerFeedbackService constructor.
     * @param CustomerFeedbackRepository $feedRepo
     */
    public function __construct(CustomerFeedbackRepository $feedRepo)
    {
        $this->feedRepo = $feedRepo;
        $this->setActionRepository($feedRepo);
    }

    /**
     * Save internet package
     * @param $request
     * @return array|int[]
     */
    public function feedBackData($request)
    {
        try {

            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $builder = new CustomerFeedback();

            if ($request->star_count) {
                $builder = $builder->where('rating', $request->star_count);
            }

            $builder = $builder->whereHas('page', function ($q) use ($request) {
                if ($request->page_name) {
                    $q->where('page_name', 'LIKE', "%$request->page_name%");
                }
            }
            )->with('page');

            if ($request->date_range != null) {
                $date = explode('-', $request->date_range);
                $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
                $to = str_replace('/', '-', $date[1]) . " " . "23:59:00";
                $builder = $builder->whereBetween('created_at', [$from, $to]);
            }

            $all_items_count = $builder->count();

            $data = $builder->skip($start)->take($length)->get();

//            dd($data);

            return [
                'data' => $data,
                'draw' => $draw,
                'recordsTotal' => $all_items_count,
                'recordsFiltered' => $all_items_count
            ];

        } catch (\Exception $e) {
            return [
                'success' => 0,
                'message' => $e->getMessage()
            ];
        }
    }
}
