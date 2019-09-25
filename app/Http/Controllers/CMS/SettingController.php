<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;
use DB;

class SettingController extends Controller
{

    /**
     * @var SettingService
     */
    private $settingService;


    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index')
                ->with('keys',DB::table('setting_keys')->get())
                ->with('settings',$this->settingService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        session()->flash('success',$this->settingService->storeSetting($request->all())->getContent());
        return redirect(route('setting.index'));
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
            return view('admin.setting.index')
                ->with('keys',DB::table('setting_keys')->get())
                ->with('settings',$this->settingService->findAll())
                ->with('setting_info',$this->settingService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        session()->flash('success',$this->settingService->updateSetting($request->all(),$id)->getContent());
        return redirect(route('setting.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error',$this->settingService->destroySetting($id)->getContent());
        return url('setting');
    }
}
