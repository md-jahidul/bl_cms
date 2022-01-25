<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SmsLanguageRequest;
use App\Services\SmsLanguageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SmsLanguageController extends Controller
{
    /**
     * @var SmsLanguageService
     */
    private $smsLanguageService;

    /**
     * SmsLanguageController constructor.
     * @param SmsLanguageService $smsLanguageService
     */
    public function __construct(SmsLanguageService $smsLanguageService)
    {
        $this->smsLanguageService = $smsLanguageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $smsLanguages = $this->smsLanguageService->findAll();
        return view('admin.sms-config.index', compact('smsLanguages'));
    }

    /**
     * @return array
     */
    private function getConfigData()
    {
        $platforms = config('constants.sms.platforms');
        $features = config('constants.sms.features');
        $langs = config('constants.sms.langs');
        return [$platforms, $features, $langs];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        [$platforms, $features] = $this->getConfigData();
        $page = 'create';
        return view('admin.sms-config.create', compact('platforms', 'features', 'page'));
    }

    /**
     * Show the form for updating an existing resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $smsLanguage = $this->smsLanguageService->findOne($id);
        if (!$smsLanguage) {
            Session::flash('error', 'Error! SMS language config not found');
            return redirect()->back();
        }
        [$platforms, $features] = $this->getConfigData();
        $page = 'edit';

        return view('admin.sms-config.create', compact('platforms', 'features', 'page', 'smsLanguage'));
    }

    public function store(SmsLanguageRequest $request)
    {
        if ($this->smsLanguageService->saveData($request->all())) {
            return redirect()->route('sms-languages.index')->with('success', 'SMS Language Config Stored!');
        }
        return redirect()->back()->with('error', 'Error! SMS Language Config is Not Stored');
    }

    public function update(SmsLanguageRequest $request, $id)
    {
        if ($this->smsLanguageService->updateData($request->all(), $id)) {
            return redirect()->route('sms-languages.index')->with('success', 'SMS Language Config Updated!');
        }
        return redirect()->back()->with('error', 'Error! SMS Language Config is Not Updated');
    }
}
