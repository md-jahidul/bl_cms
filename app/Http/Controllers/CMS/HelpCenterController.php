<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Requests\HelpCenterRequest;
use App\Http\Controllers\Controller;
use App\Services\HelpCenterService;
use App\Models\HelpCenter;

class HelpCenterController extends Controller
{
    /**
     * @var HelpCenterService
     */
    private $helpCenterService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param HelpCenterService $helpCenterService
     */
    public function __construct(HelpCenterService $helpCenterService)
    {
        $this->helpCenterService = $helpCenterService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.help-center.index')->with('helpCenters',$this->helpCenterService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.help-center.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HelpCenterRequest $request)
    {
        session()->flash('success',$this->helpCenterService->storeHelpCenter($request->all())->getContent());
        return redirect(route('helpCenter.index'));
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
    public function edit(HelpCenter $helpCenter)
    {
        return view('admin.help-center.edit')->with('helpCenter',$helpCenter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HelpCenterRequest $request,helpCenter $helpCenter)
    {
        session()->flash('success',$this->helpCenterService->updateHelpCenter($request->all(),$helpCenter)->getContent());
        return redirect(route('helpCenter.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('success',$this->helpCenterService->destroyHelpCenter($id)->getContent());
        return redirect(route('helpCenter.index'));
    }

    public function changeSequece(Request $request)
    {
        return $request->positions;
        
        foreach ($request->positions as $position) {
            $helpCenter = HelpCenter::FindorFail($position[0]);
            $helpCenter->update(['sequence' => $position[1]]);
        } 
        return "success";
        
    }
}
