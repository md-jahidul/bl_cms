<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyblCourseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use App\Services\MyblMusicService;
use App\Services\MyblSharetripService;
use Illuminate\View\View;
use Illuminate\Http\Request;


class MyblTransactionStatusController extends Controller
{
    /**
     * @var MyblCourseService
     */
    private $courseService;
    /**
     * @var MyblMusicService
     */
    private $musicService;
    /**
     * @var MyblSharetripService
     */
    private $sharetripService;

    /**
     * MyblTransactionStatusController constructor.
     */
    public function __construct(
        MyblCourseService $courseService,
        MyblMusicService $musicService,
        MyblSharetripService $sharetripService
    ) {
        $this->courseService = $courseService;
        $this->musicService = $musicService;
        $this->sharetripService = $sharetripService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.transaction-status.course_transaction_list');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCourseTransaction(Request $request)
    {
        return $this->courseService->getCourseTransaction($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function musicTransactionList()
    {
        return view('admin.transaction-status.music_transaction_list');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getMusicTransaction(Request $request)
    {
        return $this->musicService->getMusicTransaction($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function sharetripTransactionList()
    {
        return view('admin.transaction-status.sharetrip_transaction_list');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSharetripTransaction(Request $request)
    {
        return $this->sharetripService->getSharetripTransaction($request);
    }

}
