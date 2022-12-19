<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\Assetlite\AboutUsEcareerService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AboutEcareerController extends Controller
{
    /**
     * @var AboutUsEcareerService
     */
    private $aboutUsEcareerService;

    /**
     * QuickLaunchController constructor.
     * @param AboutUsEcareerService $aboutUsEcareerService
     */
    public function __construct(AboutUsEcareerService $aboutUsEcareerService)
    {
        $this->aboutUsEcareerService = $aboutUsEcareerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $aboutEcareers = $this->aboutUsEcareerService->findAll();
        return view('admin.about-us.e-career.index', compact('aboutEcareers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.about-us.e-career.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->aboutUsEcareerService->aboutCareerStore($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('about-career.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $aboutCareer = $this->aboutUsEcareerService->findOne($id);
        return view('admin.about-us.e-career.edit', compact('aboutCareer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->aboutUsEcareerService->aboutUsEcareerupdate($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(route('about-career.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
