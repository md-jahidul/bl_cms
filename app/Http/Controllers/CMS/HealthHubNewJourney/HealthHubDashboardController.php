<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\HealthHubDashboard;
use App\Services\HealthHubNewJourney\HealthHubDashboardService;
use App\Services\HealthHubNewJourney\HealthHubFeatureService;
use App\Services\HealthHubNewJourney\HealthHubPackageService;
use App\Services\HealthHubNewJourney\HealthHubPlanService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthHubDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private  $healthHubDashBoardService, $healthHubPlanService, $healthHubFeatureService;
    
    public function __construct(
        HealthHubDashboardService $healthHubDashBoardService,
        HealthHubPlanService      $healthHubPlanService,
        HealthHubFeatureService   $healthHubFeatureService
    ){
        $this->healthHubDashBoardService = $healthHubDashBoardService;
        $this->healthHubPlanService   = $healthHubPlanService;
        $this->healthHubFeatureService   = $healthHubFeatureService;
    }

    public function index()
    {
        $plans = $this->healthHubPlanService->findAll();
        $data = $this->healthHubDashBoardService->first();
        $services = $this->healthHubFeatureService->findAll();
        return view('admin.health-hub-new-journey.dashboard.index', compact('data', 'plans', 'services'));
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
        $msg = 'Error! Dashboard not saved.';
        $type = 'error';
        if ($flag == 1) {
            $msg = 'Dashboard Updated Successfully';
            $type = 'success';
        } else if($flag == 2) {
            $msg = 'Dashboard Updated Successfully';
            $type = 'success';
        } 
        return redirect()->back()->with($type, $msg);
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
        $type = 'error';
        $msg = 'Error! Dashboard Update Failed';
        $updated = $this->healthHubDashBoardService->storeOrUpdate($request->all());
        if ($updated) {
            $type = 'error';
            $msg = 'Error! Dashboard Updated Successfully';
        }
        return redirect()->back()->with($type, $msg);
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
