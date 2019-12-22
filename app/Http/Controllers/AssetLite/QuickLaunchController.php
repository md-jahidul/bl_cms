<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StoreQuickLaunch;
use App\Services\QuickLaunchService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class QuickLaunchController extends Controller
{

    /**
     * @var $quickLaunchService
     */
    private $quickLaunchService;

    /**
     * QuickLaunchController constructor.
     * @param QuickLaunchService $quickLaunchService
     */
    public function __construct(QuickLaunchService $quickLaunchService)
    {
        $this->quickLaunchService = $quickLaunchService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quickLaunchItems = $this->quickLaunchService->itemList();
        return view('admin.quick-launch-item.index', compact('quickLaunchItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.quick-launch-item.create');
    }

    /**
     * @param StoreQuickLaunch $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreQuickLaunch $request)
    {
        $response = $this->quickLaunchService->storeQuickLaunchItem($request->all());
        Session::flash('message', $response->getContent());
        return redirect('quick-launch');
    }

    public function quickLaunchSortable(Request $request)
    {
        $this->quickLaunchService->tableSortable($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $quickLaunch = $this->quickLaunchService->findOne($id);
        return view('admin.quick-launch-item.edit', compact('quickLaunch'));
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
        $response = $this->quickLaunchService->updateQuickLaunch($request->all(), $id);
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
        $response = $this->quickLaunchService->deleteQuickLaunch($id);
        Session::flash('message', $response->getContent());
        return url('quick-launch');
    }
}
