<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
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
        session()->flash('message', $this->appVersionService->createAppVersion($request)->getContent());
        return redirect(route('app-version.index'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
