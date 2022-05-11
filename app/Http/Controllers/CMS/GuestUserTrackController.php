<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\Helper;
use App\Services\GuestUserTrackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
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
        $fileDownloadStatus = Redis::get('guest_user_file_generate_status');
        $logUploadPath = env('GUEST_USER_LOG_FILE', "");
        $fileName = "guest_user.csv";
        $filePathExists = file_exists($logUploadPath . $fileName);
        return view('admin.mybl-guest-user-track.index', compact('pages', 'fileDownloadStatus', 'filePathExists'));
    }

    public function dataExport(Request $request)
    {
        $response = $this->guestUserTrackService->dataExportGenerator($request);
        session()->flash('message', $response->getContent());
        return redirect(route('guest-user-track-list'));
    }

    public function showData(Request $request)
    {
        return $this->guestUserTrackService->dataExportGenerator($request, $showData = true);
    }

    public function downloadFile()
    {
        return $this->guestUserTrackService->fileDownloadRequest();
    }
}
