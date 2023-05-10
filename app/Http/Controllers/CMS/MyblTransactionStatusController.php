<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyblCourseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use App\Services\MyblMusicService;
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
     * MyblTransactionStatusController constructor.
     */
    public function __construct(
        MyblCourseService $courseService,
        MyblMusicService $musicService
    ) {
        $this->courseService = $courseService;
        $this->musicService = $musicService;
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

}
