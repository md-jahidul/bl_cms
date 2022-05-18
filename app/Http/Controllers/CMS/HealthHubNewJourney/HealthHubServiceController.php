<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\HealthHubService;
use App\Services\HealthHubNewJourney\HealthHubDashboardService;
use App\Services\HealthHubNewJourney\HealthHubFeatureService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthHubServiceController extends Controller
{
    private $healthHubFeatureService, $healthHubDashBoardService;

    public function __construct(HealthHubFeatureService $healthHubFeatureService, HealthHubDashboardService $healthHubDashBoardService)
    {
        $this->healthHubFeatureService   = $healthHubFeatureService;
        $this->healthHubDashBoardService = $healthHubDashBoardService;
    }
    public function index()
    {
        $services = $this->healthHubFeatureService->findAll();
        return view('admin.health-hub-new-journey.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.health-hub-new-journey.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->healthHubFeatureService->save($request->all()))Session()->flash('message', 'Service Created successfully.');
        else session()->flash('warning', 'Service Created Failed');

        return redirect('health-hub-feature-dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HealthHubService  $healthHubService
     * @return \Illuminate\Http\Response
     */
    public function show(HealthHubService $healthHubService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HealthHubService  $healthHubService
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $service = $this->healthHubFeatureService->findOne($id);

        return view('admin.health-hub-new-journey.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HealthHubService  $healthHubService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->healthHubFeatureService->update($request->all(), $id))Session()->flash('message', 'Service Update successfully.');
        else session()->flash('warning', 'Service Updated Failed');

        return redirect('health-hub-feature-dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HealthHubService  $healthHubService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->healthHubFeatureService->destroy($id);
    }

    public function updateDashboardId($id){
        $dashboard = $this->healthHubDashBoardService->first();
        $this->healthHubFeatureService->updateDashboardId($id, $dashboard->id);

        return [
            'value' => true
        ];
    }

    public function deleteDashboardId($id){

        $this->healthHubFeatureService->deleteDashboardId($id);

        return [
            'value' => true
        ];
    }
}
