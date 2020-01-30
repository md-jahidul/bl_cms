<?php

namespace App\Http\Controllers\AssetLite;

use App\Services\ManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{

    /**
     * @var $managementService
     */
    protected $managementService;

    /**
     * QuickLaunchController constructor.
     * @param ManagementService $managementService
     */
    public function __construct(ManagementService $managementService)
    {
        $this->managementService = $managementService;
       // $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $management = $this->managementService->getManagementInfo();
        return view('admin.management.index', compact('management'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.management.create');
    }

    /**
     * @param StoreQuickLaunch $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $response = $this->managementService->storeManagementInfo($request->all());
        Session::flash('message', $response->getContent());
        return redirect('management');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $management = $this->managementService->findOne($id);
        return view('admin.management.edit', compact('management'));
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
        $response = $this->managementService->updateQuickLaunch($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/about-us');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->managementService->deleteQuickLaunch($id);
        Session::flash('message', $response->getContent());
        return url('about-us');
    }
}
