<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use App\Services\AppVersionService;
use Illuminate\Http\Request;

/**
 * Class AppVersionController
 * @package App\Http\Controllers\CMS
 */
class AppVersionController extends Controller
{

    /**
     * @var AppVersionService
     */
    protected $appVersionService;


    /**
     * AppVersionController constructor.
     * @param AppVersionService $appVersionService
     */
    public function __construct(AppVersionService $appVersionService)
    {
        $this->appVersionService = $appVersionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versions = $this->appVersionService->getVersionInfo();

        return view('admin.app-version.index')->with('versions', $versions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.app-version.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response =  $this->appVersionService->createAppVersion($request);

        if ($response) {
            session()->flash('success', "app version created successfully");
            return redirect(route('app-version.index'));
        }

        session()->flash('message', "Failed! Please try again");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AppVersion $app_version
     * @return \Illuminate\Http\Response
     */
    public function edit(AppVersion $app_version)
    {
        return view('admin.app-version.create')->with('version', $app_version);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param AppVersion $app_version
     * @return void
     */
    public function update(Request $request, AppVersion $app_version)
    {
        $response = $this->appVersionService->updateAppVersion($request, $app_version);

        if ($response) {
            session()->flash('success', "Updated successfully");
            return redirect(route('app-version.index'));
        }

        session()->flash('message', "Failed! Please try again");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->appVersionService->deleteAppVersion($id);

        if ($response) {
            session()->flash('error', "Deleted successfully");
            return redirect(route('app-version.index'));
        }

        session()->flash('message', "Failed! Please try again");
    }
}
