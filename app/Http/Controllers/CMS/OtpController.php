<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppVersionRequest;
use App\Http\Requests\OtpConfigRequest;
use App\Models\AppVersion;
use App\Models\OtpConfig;
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
     * @param OtpConfigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtpConfigRequest $request)
    {
        $response =  $this->otpService->createOtpConfig($request);

        if ($response) {
            session()->flash('success', "Created successfully");
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
     * @param OtpConfig $otp_config
     * @return \Illuminate\Http\Response
     */
    public function edit(OtpConfig $otp_config)
    {
        return view('admin.otp-config.create')->with('config', $otp_config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OtpConfigRequest $request
     * @param OtpConfig $otp_config
     * @return void
     */
    public function update(OtpConfigRequest $request, OtpConfig $otp_config)
    {
        $response = $this->otpService->updateOtpConfig($request, $otp_config);

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
