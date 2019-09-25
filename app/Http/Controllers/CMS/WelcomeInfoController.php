<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use App\Models\WelcomeInfo;
use App\Services\WelcomeInfoService;
use App\Http\Requests\WelcomeInfoRequest;

class WelcomeInfoController extends Controller
{


    /**
     * @var WelcomeInfoService
     */
    private $welcomeInfoService;


    /**
     * WelcomeInfoController constructor.
     * @param WelcomeInfoService $welcomeInfoService
     */
    public function __construct(WelcomeInfoService $welcomeInfoService)
    {
        $this->welcomeInfoService = $welcomeInfoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.welcomeInfo.index')->with('welcomeInfo',$this->welcomeInfoService->findAll()->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.welcomeInfo.create')->with('welcomeInfo',$this->welcomeInfoService->findAll()->first());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param WelcomeInfoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(WelcomeInfoRequest $request)
    {
        session()->flash('status',$this->welcomeInfoService->storeWelcomeInfo($request->all())->getContent());
        return redirect(route('welcomeInfo.index'));
    }


    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('admin.welcomeInfo.create')
                ->with('welcomeInfo',$this->welcomeInfoService->findOne($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param WelcomeInfoRequest $request
     * @param WelcomeInfo $welcomeInfo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(WelcomeInfoRequest $request, WelcomeInfo $welcomeInfo)
    {
        session()->flash('status',$this->welcomeInfoService->updateWelcomeInfo($request, $welcomeInfo)->getContent());
        return redirect(route('welcomeInfo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id)
    {
        dd($id);
    }
}
