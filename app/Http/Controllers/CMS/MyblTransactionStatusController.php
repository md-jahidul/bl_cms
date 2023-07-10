<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyblCourseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use App\Services\MyblDoctimeService;
use App\Services\MyblMusicService;
use App\Services\MyblSharetripService;
use App\Services\MyblTransactionStatusService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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
     * @var MyblDoctimeService
     */
    private $doctimeService;

    /**
     * @var MyblTransactionStatusService
     */
    private $transactionStatusService;

    /**
     * MyblTransactionStatusController constructor.
     */
    public function __construct(
        MyblCourseService $courseService,
        MyblMusicService $musicService,
        MyblSharetripService $sharetripService,
        MyblDoctimeService $doctimeService,
        MyblTransactionStatusService $transactionStatusService
    ) {
        $this->courseService = $courseService;
        $this->musicService = $musicService;
        $this->sharetripService = $sharetripService;
        $this->doctimeService = $doctimeService;
        $this->transactionStatusService = $transactionStatusService;
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
    
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function doctimeTransactionList()
    {
        return view('admin.transaction-status.doctime_transaction_list');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDoctimeTransaction(Request $request)
    {
        return $this->doctimeService->getDoctimeTransaction($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function getTransactionList($type)
    {
        $view = "";

        if (in_array($type, ['bus'])) {
            $view = $type.'_transaction_list';
            return view('admin.transaction-status.'.$view);
        }else{
            throw new NotFoundHttpException();
        }

    }

    /**
     * @param Request $request
     * @return array
     */
    public function getTransaction(Request $request, $type)
    {
        if($type == 'bus') return $this->transactionStatusService->getBusTransaction($request);
    }

}
