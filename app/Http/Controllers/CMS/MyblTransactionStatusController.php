<?php

namespace App\Http\Controllers\CMS;

use App\Services\MyblCourseService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;


class MyblTransactionStatusController extends Controller
{
    /**
     * @var MyblCourseService
     */
    private $courseService;

    /**
     * MyblTransactionStatusController constructor.
     */
    public function __construct(
        MyblCourseService $courseService
    ) {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.transaction-status.index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCourseTransaction(Request $request)
    {
        return $this->courseService->getCourseTransaction($request);
    }

}
