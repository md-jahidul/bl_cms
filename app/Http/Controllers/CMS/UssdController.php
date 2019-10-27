<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Requests\UssdRequest;
use App\Http\Controllers\Controller;
use App\Services\UssdService;
use Illuminate\Support\Facades\Session;

class UssdController extends Controller
{
    /**
     * @var UssdService
     */
    private $ussdService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param UssdService $ussdService
     */
    public function __construct(UssdService $ussdService)
    {
        $this->ussdService = $ussdService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ussd-code.index')->with('ussd_cods', $this->ussdService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ussd-code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UssdRequest $request)
    {
        $response = $this->ussdService->storeUssd($request->all());
        Session::flash('message', $response->content());
        return redirect(route('ussd.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ussd = $this->ussdService->findOne($id);
        return view('admin.ussd-code.show')->with('ussd_code', $ussd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.ussd-code.edit')->with('ussd_code', $this->ussdService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UssdRequest $request, $id)
    {
        session()->flash('success', $this->ussdService->updateUssd($request, $id)->getContent());
        return redirect(route('ussd.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->ussdService->deleteUssd($id)->getContent());
        return url('ussd');
    }
}
