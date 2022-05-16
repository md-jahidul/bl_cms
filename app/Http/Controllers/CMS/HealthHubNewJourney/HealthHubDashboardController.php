<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\HealthHubDashboard;
use App\Services\HealthHubNewJourney\HealthHubDashboardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthHubDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private  $healthHubDashBoardService;
    public function __construct(HealthHubDashboardService $healthHubDashBoardService)
    {
        $this->healthHubDashBoardService = $healthHubDashBoardService;
    }

    public function index()
    {
        $data = $this->healthHubDashBoardService->findAll();
        // dd($data[0]);
        $data = $data[0];
        return view('admin.health-hub-new-journey.dashboard.index', compact('data'));
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
    public function store(Request $request)
    {
        $flag = $this->healthHubDashBoardService->storeOrUpdate($request->all());
        if ($flag == 2) return redirect()->back()->with('success', 'Dashboard Added successfully.');
        else if($flag=1)return redirect()->back()->with('success', 'Dashboard Update Successfully.');
        
        return redirect()->back()->with('error', 'Error! Dashboard not saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HealthHubDashboard  $healthHubDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(HealthHubDashboard $healthHubDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HealthHubDashboard  $healthHubDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthHubDashboard $healthHubDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HealthHubDashboard  $healthHubDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->healthHubDashBoardService->storeOrUpdate($request->all())) {
            return redirect()->back()->with('success', 'Dashboard Update Successfully.');
        }

        return redirect()->back()->with('error', 'Error! Dashboard not Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HealthHubDashboard  $healthHubDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
