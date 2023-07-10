<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MyblAdTech;
use App\Services\BaseMsisdnService;
use App\Services\MyblAdTechService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyblAdTechController extends Controller
{
    private  $baseMsisdnService, $myblAdTechService;

    public function __construct(
        BaseMsisdnService $baseMsisdnService,
        MyblAdTechService $myblAdTechService
    ) {
        $this->baseMsisdnService = $baseMsisdnService;
        $this->myblAdTechService = $myblAdTechService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBy = ['column' => 'display_order', 'direction' => 'ASC'];
        $adTechs = $this->myblAdTechService->findAll(null, null,  $orderBy);

        return view('admin.ad-tech.index', compact('adTechs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.ad-tech.create', compact('baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->myblAdTechService->save($request->all())) {
            Session::flash('message', 'Image store successful');
        }
        else{
            Session::flash('danger', 'Image Stored Failed');
        }

        return redirect('ad-tech');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyblAdTech  $myblAdTech
     * @return \Illuminate\Http\Response
     */
    public function show(MyblAdTech $myblAdTech)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyblAdTech  $myblAdTech
     * @return \Illuminate\Http\Response
     */
    public function edit($myblAdTechId)
    {
        $adTech = $this->myblAdTechService->findOne($myblAdTechId);
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.ad-tech.edit', compact('baseMsisdnGroups', 'adTech'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyblAdTech  $myblAdTech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $myblAdTechId)
    {
        if ($this->myblAdTechService->update($myblAdTechId, $request->all())) {
            Session::flash('message', 'Image Update successful');
        }
        else{
            Session::flash('danger', 'Image Update Failed');
        }

        return redirect('ad-tech');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyblAdTech  $myblAdTech
     * @return \Illuminate\Http\Response
     */
    public function destroy($myblAdTechId)
    {
        $this->myblAdTechService->delete($myblAdTechId);
        return redirect('ad-tech');
    }

    public function updatePosition(Request $request)
    {
        return $this->myblAdTechService->updateOrdering($request);
    }
}
