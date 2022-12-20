<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\AppServiceTabRequest;
use App\Services\Assetlite\AppServiceTabService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AppServiceTabController extends Controller
{

    private $appServiceTabService;

    /**
     * AppServiceTabController constructor.
     * @param AppServiceTabService $appServiceTabService
     */
    public function __construct(AppServiceTabService $appServiceTabService)
    {
        $this->appServiceTabService = $appServiceTabService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tabList = $this->appServiceTabService->findAll();
        return view('admin.app-service.tabs.index', compact('tabList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $appServiceTab = $this->appServiceTabService->findOne($id);
        return view('admin.app-service.tabs.edit', compact('appServiceTab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(AppServiceTabRequest $request, $id)
    {
        $response = $this->appServiceTabService->updateTabs($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect("app-service/tabs");
    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        $response = $this->appServiceTabService->deleteAppServiceTab($id);
//        Session::flash('message', $response->getContent());
//        return route('tabs.index');
//    }
}
