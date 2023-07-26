<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 26-Aug-19
 * Time: 4:31 PM
 */

namespace App\Services\BlLab;

use App\Models\BlLab\BlLabApplication;
use App\Repositories\BlLab\BlLabApplicationRepository;
use App\Repositories\BlLab\BlLabEducationRepository;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class BlLabApplicationService
{
    use CrudTrait;

    /**
     * @var BlLabApplicationRepository
     */
    private $labApplicationRepository;

    /**
     * BlLabApplicationService constructor.
     * @param BlLabApplicationRepository $labApplicationRepository
     */
    public function __construct(
        BlLabApplicationRepository $labApplicationRepository
//        BlLabSu $labApplicationRepository
    ) {
        $this->labApplicationRepository = $labApplicationRepository;
        $this->setActionRepository($labApplicationRepository);
    }

    /**
     * @return array
     */
    public function getApplications($request)
    {
//        dd($request->all());
        try {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');

            $builder = new BlLabApplication();



//            if ($request->star_count) {
//                $builder = $builder->where('rating', $request->star_count);
//            }

            $builder = $builder->whereHas('summary', function ($q) use ($request) {
                if ($request->program) {
                    $q->where('apply_for', "$request->program");
                }
            })->with('summary');

            if ($request->id_number != null) {
                $builder = $builder->where('id_number', $request->id_number);
            }
//
            if ($request->submitted_at != null) {
                $date = explode('-', $request->submitted_at);
                $from = str_replace('/', '-', $date[0]);
                $to = str_replace('/', '-', $date[1]);
                $builder = $builder->whereBetween('submitted_at', [$from, $to]);
            }

            $all_items_count = $builder->count();

            $data = $builder->skip($start)->take($length)
                ->orderBy('created_at', 'DESC')
                ->get();
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
