<?php

namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\wellcomeInfoService;
use App\Models\WellcomeInfo;

class WellcomeInfoController extends Controller
{

     /**
     * @var SliderService
     */
    private $wellcomeInfoService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param WellcomeInfoService $sliderService
     */
    public function __construct(WellcomeInfoService $wellcomeInfoService)
    {
        $this->wellcomeInfoService = $wellcomeInfoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.wellcomeinfo.index')->with('wellcomeInfo',$this->wellcomeInfoService->findAll()->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wellcomeinfo.create')->with('wellcomeInfo',$this->wellcomeInfoService->findAll()->first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('status',$this->wellcomeInfoService->storeWellcomeInfo($request->all())->getContent());
        return redirect(route('wellcomeInfo.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
       return view('admin.wellcomeInfo.create')
                ->with('wellcomeInfo',$this->wellcomeInfoService->findAll())
                ->with('wellcomeInfoService',$wellcomeInfoService);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,WellcomeInfo $wellcomeInfo)
    {
        session()->flash('status',$this->wellcomeInfoService->updateWellcomeInfo($request, $wellcomeInfo)->getContent());
        return redirect(route('wellcomeInfo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
