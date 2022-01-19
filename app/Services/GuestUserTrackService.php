<?php

/**
 * Created by PhpStorm.
 * User: BS23
 * Date: 27-Aug-19
 * Time: 3:56 PM
 */

namespace App\Services;

use App\Models\GuestUserAccessTracks;
use App\Repositories\GuestUserTrackRepository;
use App\Traits\CrudTrait;

class GuestUserTrackService
{
    use CrudTrait;

    /**
     * @var $prizeService
     */
    protected $aboutPageRepository;

    /**
     * GuestUserTrackService constructor.
     * @param GuestUserTrackRepository $guestUserTrackRepository
     */
    public function __construct(GuestUserTrackRepository $guestUserTrackRepository)
    {
        $this->aboutPageRepository = $guestUserTrackRepository;
        $this->setActionRepository($guestUserTrackRepository);
    }

    public function getGuestUserData($request)
    {
//        dd($request->all());

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');

        $builder = new GuestUserAccessTracks();

        if (isset($request->device_id)) {
            $builder = $builder->where('device_id', 'LIKE', "%$request->device_id%");
        }

        if (isset($request->platform)) {
            $builder = $builder->where('platform', $request->platform);
        }

        if (isset($request->page_name)) {
            $builder = $builder->where('page_name', 'LIKE', "%$request->page_name%");
        }

        if (isset($request->msisdn)) {
            $builder = $builder->where('msisdn', 'LIKE', "%$request->msisdn%");
        }

        if (isset($request->msisdn_entry_type)) {
            $builder = $builder->where('msisdn_entry_type', $request->msisdn_entry_type);
        }

        if (isset($request->status)) {
            $builder = $builder->where('status', $request->status);
        }

        if (isset($request->date_range)) {
            $date = explode('-', $request->date_range);
            $from = str_replace('/', '-', $date[0]) . " " . "00:00:00";
            $to = str_replace('/', '-', $date[1]) . " " . "23:59:00";
            $builder = $builder->whereBetween('created_at', [$from, $to]);
        }

        $all_items_count = $builder->count();

        if ($length > 1) {
            $items = $builder->skip($start)->take($length)->orderBy('created_at', 'DESC')->get();
        } else {
            $items = $builder->orderBy('created_at', 'DESC')->get();
        }


        $response = [
            'draw' => $draw,
            'recordsTotal' => $all_items_count,
            'recordsFiltered' => $all_items_count,
            'data' => $items
        ];

        return $response;
    }
}
