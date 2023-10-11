<?php

namespace App\Http\Controllers\CMS;


use App\Services\GlobalSettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use DB;

class GlobalSettingController extends Controller
{

    /**
     * @var SettingService
     */
    private $settingService;


    /**
     * SettingController constructor.
     * @param SettingService $settingService
     */
    public function __construct(GlobalSettingService $settingService)
    {
        $this->settingService = $settingService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filterKey = $request->query('key');
        $settings = $this->settingService->getFilteredData($filterKey);
//        dd($settings);
        return view('admin.global-settings.index', compact('settings'));

    }

    public function create()
    {
        return view('admin.global-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $response = $this->settingService->storeSetting($request);
        if ($response['saved']) {
            return redirect(route('global-settings.index'));
        } else {
            return redirect()->back()->with('error', 'Duplicate Setting Key');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $settings = $this->settingService->findOne($id);
        return view('admin.global-settings.update', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        session()->flash('success', $this->settingService->updateSetting($request->all(), $id)->getContent());
        return redirect(route('global-settings.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Http\Response|string
     * @throws \Exception
     */
    public function destroy($id)
    {
        session()->flash('error', $this->settingService->destroySetting($id)->getContent());
        return url('global-settings');
    }
}
