<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\Assetlite\AboutUsEcareerItemService;
use App\Services\Assetlite\AboutUsEcareerService;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AboutEcareerItemController extends Controller
{

    /**
     * @var AboutUsEcareerService
     */
    private $aboutUsEcareerService;
    /**
     * @var AboutUsEcareerItemService
     */
    private $aboutUsEcareerItemService;

    /**
     * QuickLaunchController constructor.
     * @param AboutUsEcareerService $aboutUsEcareerService
     * @param AboutUsEcareerItemService $aboutUsEcareerItemService
     */
    public function __construct(
        AboutUsEcareerService $aboutUsEcareerService,
        AboutUsEcareerItemService $aboutUsEcareerItemService
    ) {
        $this->aboutUsEcareerService = $aboutUsEcareerService;
        $this->aboutUsEcareerItemService = $aboutUsEcareerItemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index($careerId)
    {
        $aboutCareerItems = $this->aboutUsEcareerItemService->aboutCareerItems($careerId);

        return view('admin.about-us.e-career-item.index', compact('aboutCareerItems', 'careerId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $careerId
     * @return Response
     */
    public function create($careerId)
    {
        return view('admin.about-us.e-career-item.create', compact('careerId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $careerId
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request, $careerId)
    {
        $request->validate([
           'image_name' => 'unique:about_us_ecareer_items,image_name',
           'image_name_bn' => 'unique:about_us_ecareer_items,image_name_bn',
        ]);

        $response = $this->aboutUsEcareerItemService->storeAboutCareerItems($request->all(), $careerId);
        Session::flash('message', $response->getContent());
        return redirect(route('career-item.list', $careerId));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $careerId
     * @param int $id
     * @return Factory|View
     */
    public function edit($careerId, $id)
    {
        $aboutCareerItem = $this->aboutUsEcareerItemService->findOne($id);
        return view('admin.about-us.e-career-item.edit', compact('careerId', 'aboutCareerItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $careerId, $id)
    {
        $request->validate([
            'image_name' => 'unique:about_us_ecareer_items,image_name,' . $id,
            'image_name_bn' => 'unique:about_us_ecareer_items,image_name_bn,' . $id,
        ]);

        $response = $this->aboutUsEcareerItemService->updateAboutCareerItems($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('career-item.list', $careerId));
    }

    /**
     * @param $careerId
     * @param $id
     * @return UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($careerId, $id)
    {
        $this->aboutUsEcareerItemService->deleteAboutCareerItem($id);
        return url(route('career-item.list', $careerId));
    }

    /**
     * @param Request $request
     */
    public function aboutUsCareerSortable(Request $request)
    {
        $this->aboutUsEcareerItemService->tableSortable($request);
    }


}
