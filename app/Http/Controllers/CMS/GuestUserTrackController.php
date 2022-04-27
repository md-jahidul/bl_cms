<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Services\GuestUserTrackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class GuestUserTrackController extends Controller
{
    /**
     * @var GuestUserTrackService
     */
    private $guestUserTrackService;

    /**
     * GuestUserTrackController constructor.
     * @param GuestUserTrackService $guestUserTrackService
     */
    public function __construct(
        GuestUserTrackService $guestUserTrackService
    ) {
        $this->guestUserTrackService = $guestUserTrackService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|Application|Factory|View
     */
    public function index()
    {
        $pages = Helper::guestUserActivityList();
        return view('admin.mybl-guest-user-track.index', compact('pages'));
    }

    public function dataExport(Request $request)
    {
        return  $this->guestUserTrackService->dataExportGenerator($request);
    }

    public function showData(Request $request)
    {
        return $this->guestUserTrackService->dataExportGenerator($request, $showData = true);
    }
}
