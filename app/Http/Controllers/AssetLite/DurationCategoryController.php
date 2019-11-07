<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Models\DurationCategory;
use App\Services\DurationCategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class DurationCategoryController extends Controller
{

    /**
     * @var $tagCategoryService
     */
    private $durationCategoryService;

    /**
     * DurationCategoryController constructor.
     * @param DurationCategoryService $durationCategoryService
     */
    public function __construct(DurationCategoryService $durationCategoryService)
    {
        $this->durationCategoryService = $durationCategoryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $durationCategories = DurationCategory::all();
        return view('admin.category.duration.index', compact('durationCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.category.duration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->durationCategoryService->storeDurationCategory($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/duration-categories');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $duration = $this->durationCategoryService->findOne($id);
        return view('admin.category.duration.edit', compact('duration'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->durationCategoryService->updateDurationCategory($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/duration-categories');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->durationCategoryService->deleteDurationCategory($id);
        Session::flash('message', $response->getContent());
        return url('/duration-categories');
    }
}
