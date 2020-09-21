<?php

/**
 * Created by PhpStorm.
 * User: bs-205
 * Date: 18/08/19
 * Time: 17:23
 */

namespace App\Services;

use App\Models\CustomerFeedback;
use App\Models\CustomerFeedbackPage;
use App\Repositories\CustomerFeedbackPageRepository;
use App\Repositories\CustomerFeedbackRepository;
use App\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;

class CustomerFeedbackService
{

    use CrudTrait;

    /**
     * @var $feedRepo
     */
    protected $feedRepo;
    /**
     * @var CustomerFeedbackPage
     */
    private $customerFeedbackPage;

    /**
     * CustomerFeedbackService constructor.
     * @param CustomerFeedbackRepository $feedRepo
     * @param CustomerFeedbackPageRepository $customerFeedbackPageRepository
     */
    public function __construct(
        CustomerFeedbackRepository $feedRepo,
        CustomerFeedbackPageRepository $customerFeedbackPageRepository
    )
    {
        $this->feedRepo = $feedRepo;
        $this->customerFeedbackPage = $customerFeedbackPageRepository;
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

            if ($request->order[0]['column'] == 2) {
//                dd($request->order);
                $builder = $builder->orderBy('rating', $request->order[0]['dir']);
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

            $data = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();

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

    public function pageRatingInfo()
    {
        $results = DB::select(DB::raw("
              SELECT
                    AA.id, AA.page_name,
                    sum(feedback_count) total_feedbacks,
                    sum(case when rating = 1 then feedback_count else 0 end) as one_star,
                    sum(case when rating = 2 then feedback_count else 0 end) as two_star,
                    sum(case when rating = 3 then feedback_count else 0 end) as three_star,
                    sum(case when rating = 4 then feedback_count else 0 end) as four_star,
                    sum(case when rating = 5 then feedback_count else 0 end) as five_star
              FROM (
                     SELECT f.rating, p.id, p.page_name, count(1) feedback_count
                     from customer_feedback f
                              Inner join customer_feedback_pages p on f.page_id = p.id -- where page_id = {parameter}
                     group by f.rating, f.page_id, p.page_name
                ) AA
                group by AA.id, AA.page_name
            ")
        );
        return $results;
    }
}
