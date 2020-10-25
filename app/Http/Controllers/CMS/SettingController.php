<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use App\Models\Setting;
use App\Models\SettingKey;
use App\Models\MyBlAppSettings;
use App\Enums\MyBlAppSettingsKey;
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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys=SettingKey::get();
        $settings= $this->settingService->findAll();
        return view('admin.setting.index',compact('keys','settings'));
    }

    /**
     * Display logde a complain page in menu -> config/logde complain      *
     * @return \Illuminate\Http\Response
     * @author Ahsan Habib <habib.cst@gmail.com>
     * This methord use only logdge complaine page view
     */
    public function lodgeComplain(Request $request)
    {
        $app_settings = MyBlAppSettings::where('key', MyBlAppSettingsKey::LODGE_COMPLAIN_SETTINGS)->first();
        if(empty($app_settings)){
            $settings=['is_enable'=>false];
        }else{
            $settings = json_decode($app_settings->value);
        }



        // dd($settings);
        return view('admin.config.lodge_complain.index',compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function sotreLodgeComplain(Request $request)
    {
        $data = [
            'is_enable'             => ($request->is_enable) ? true : false
          ];

        try {
            MyBlAppSettings::updateOrCreate(
                ['key' => MyBlAppSettingsKey::LODGE_COMPLAIN_SETTINGS],
                ['value' => json_encode($data)]
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Settings updated successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        session()->flash('message', $this->settingService->storeSetting($request->all())->getContent());
        return redirect(route('setting.index'));
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
                ->with('keys', DB::table('setting_keys')->get())
                ->with('settings', $this->settingService->findAll())
                ->with('setting_info', $this->settingService->findOne($id));
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
        session()->flash('success', $this->settingService->updateSetting($request->all(), $id)->getContent());
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
        session()->flash('error', $this->settingService->destroySetting($id)->getContent());
        return url('setting');
    }
}
