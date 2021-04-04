<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\ProductActivityService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductActivityController extends Controller
{

    /**
     * @var ProductActivityService
     */
    private $activityService;

    /**
     * ProductActivityController constructor.
     * @param ProductActivityService $activityService
     */
    public function __construct(ProductActivityService $activityService)
    {
        $this->activityService = $activityService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array|Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $builder = $this->activityService->getAll()->latest();
            return $this->activityService->prepareDataForDatatable($builder, $request);
        }
        return view('admin.mybl-product-activity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function show($id)
    {
        $activity = $this->activityService->findOne($id);
        return view('admin.mybl-product-activity.view_details', compact('activity'));
    }
}
