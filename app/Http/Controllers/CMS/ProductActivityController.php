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
//        $activities = $this->activityService->findAll();

        if ($request->ajax()) {
//            $builder = $this->activityService->findAll('', '', [
//                'column' => 'created_at',
//                'direction' => "DESC"
//            ]);

            $builder = $this->activityService->getAll()->latest();

//            dd($builder);
            return $this->activityService->prepareDataForDatatable($builder, $request);
        }
        return view('admin.mybl-product-activity.index', compact('activities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //return view('admin.banner.show');
    }
}
