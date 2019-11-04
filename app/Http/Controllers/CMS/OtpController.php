<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppVersionRequest;
use App\Models\AppVersion;
use App\Services\AppVersionService;
use App\Services\OtpService;

/**
 * Class AppVersionController
 * @package App\Http\Controllers\CMS
 */
class OtpController extends Controller
{

    /**
     * @var OtpService
     */
    protected $otpService;


    /**
     * OtpController constructor.
     * @param OtpService $otpService
     */
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = $this->otpService->getOtpConfigInfo();

        return view('admin.otp-config.index')->with('configs', $configs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.otp-config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AppVersionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppVersionRequest $request)
    {
        $response =  $this->otpService->createAppVersion($request);

        if ($response) {
            session()->flash('success', "app version created successfully");
            return redirect(route('otp-config.index'));
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
        return view('admin.otp-config.create')->with('version', $app_version);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AppVersionRequest $request
     * @param AppVersion $app_version
     * @return void
     */
    public function update(AppVersionRequest $request, AppVersion $app_version)
    {
        $response = $this->otpService->updateOtpConfig($request, $app_version);

        if ($response) {
            session()->flash('success', "Updated successfully");
            return redirect(route('otp-config.index'));
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
        $response = $this->otpService->deleteOtpConfig($id);

        if ($response) {
            session()->flash('error', "Deleted successfully");
            return redirect(route('otp-config.index'));
        }

        session()->flash('message', "Failed! Please try again");
    }
}
