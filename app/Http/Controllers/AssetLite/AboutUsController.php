<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\AboutUsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{

    /**
     * @var $aboutUsService
     */
    private $aboutUsService;

    /**
     * QuickLaunchController constructor.
     * @param AboutUsService $aboutUsService
     */
    public function __construct(AboutUsService $aboutUsService)
    {
        $this->aboutUsService = $aboutUsService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quickLaunchItems = $this->aboutUsService->itemList();
        return view('admin.about-us.index', compact('quickLaunchItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.about-us.create');
    }

    /**
     * @param StoreQuickLaunch $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreQuickLaunch $request)
    {
        $response = $this->aboutUsService->storeQuickLaunchItem($request->all());
        Session::flash('message', $response->getContent());
        return redirect('quick-launch');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $quickLaunch = $this->aboutUsService->findOne($id);
        return view('admin.about-us.edit', compact('quickLaunch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->aboutUsService->updateQuickLaunch($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/quick-launch');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->aboutUsService->deleteQuickLaunch($id);
        Session::flash('message', $response->getContent());
        return url('quick-launch');
    }
}
