<?php

namespace App\Services;

use App\Repositories\SupportMessageRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\SupportMessageRating;
use Illuminate\Support\Carbon;

class SupportMessageService
{
    use CrudTrait;

    /**
     * supportMessageRepository
     *
     * @var mixed
     */
    protected $supportMessageRepository;

    /**
     * __construct
     *
     * @param  mixed $supportMessageRepository
     * @return void
     */
    public function __construct(SupportMessageRepository $supportMessageRepository)
    {
        $this->supportMessageRepository = $supportMessageRepository;
        $this->setActionRepository($supportMessageRepository);

    }

    public function getAll()
    {
        return new SupportMessageRating();
    }

    /**
     * prepareDataForDatatable
     *
     * @param  mixed $itemBuilder
     * @param  mixed $request
     * @return void
     */
    public function prepareDataForDatatable(Builder $itemBuilder, Request $request)
    {


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $all_items_count = $itemBuilder->count();
        // $items = $itemBuilder->paginate($length, ['*'], null, (int)$start / $length + 1);

        if ($request->date != '') {
            $date=explode('=',$request->date);
            $start_date=Carbon::parse($date[0])->format('Y-m-d').' 00:00:00';
            $end_date=Carbon::parse($date[1])->format('Y-m-d').' 23:59:59';
            $itemBuilder->whereBetween('created_at', [$start_date, $end_date]);
        }

        if ($request->ratings != '') {
            $ratings=$request->ratings;
            $itemBuilder->where('ratings', $ratings);
        }

        $items = $itemBuilder->skip($start)->take($length)->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => []
        ];

        $items->each(function ($item) use (&$response) {
            $response['data'][] = [
                'id' => $item->id,
                'msisdn' => $item->msisdn,
                'ticketId' => $item->ticketId,
                'ratings' => $item->ratings,
                'category_name' => $item->category_name,
                'complaint_location' => $item->complaint_location,
                'status' => $item->status
            ];
        });

        return $response;
    }

}
