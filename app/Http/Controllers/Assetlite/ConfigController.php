<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use App\Services\ConfigService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{
    /**
     * @var $configService
     */
    private $configService;

    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
        $this->middleware('auth');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::all();
        return view('admin.config.index', compact('configs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigRequest $request)
    {
        $response = $this->configService->updateConfigData($request->all());
        Session::flash('message', $response->getContent());
        return redirect( "/config");
    }

}
