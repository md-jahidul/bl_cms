<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\Http\Controllers\Controller;
use App\Models\HealthHubNewJourney\HealthHubPackage;
use App\Services\HealthHubNewJourney\HealthHubDashboardService;
use App\Services\HealthHubNewJourney\HealthHubPackageService;
use App\Services\HealthHubNewJourney\HealthHubPartnerService;
use App\Services\HealthHubNewJourney\HealthHubPlanService;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class HealthHubPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $healthHubPackageService, $healthHubPartnerService, $healthHubPlanService, $healthHubDashBoardService;

    public function __construct(
        HealthHubPackageService     $healthHubPackageService,
        HealthHubPartnerService     $healthHubPartnerService,
        HealthHubPlanService        $healthHubPlanService,
        HealthHubDashboardService   $healthHubDashBoardService

    ){
        $this->healthHubPackageService      = $healthHubPackageService;
        $this->healthHubPartnerService      = $healthHubPartnerService;
        $this->healthHubPlanService         = $healthHubPlanService;
        $this->healthHubDashBoardService    = $healthHubDashBoardService;
     }
    public function index()
    {
        $packages = $this->healthHubPackageService->findAll();
        return view('admin.health-hub-new-journey.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans    = $this->healthHubPlanService->findAll();
        $partners = $this->healthHubPartnerService->findAll();
        return view('admin.health-hub-new-journey.package.create', compact('partners', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = 'warning';
        $msg = 'HealthHub Package Update successfully.';
        $saved = $this->healthHubPackageService->save($request->all());
        if($saved) {
            $type = 'message';
            $msg = 'HealthHub Package Created successfully.';
        }     
        session()->flash($type, $msg);
        return redirect('health-hub-feature-package');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackage  $healthHubPackage
     * @return \Illuminate\Http\Response
     */
    public function show(HealthHubPackage $healthHubPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackage  $healthHubPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partners = $this->healthHubPartnerService->findAll();
        $plans    = $this->healthHubPlanService->findAll();
        $package  = $this->healthHubPackageService->findOne($id);
        return view('admin.health-hub-new-journey.package.edit', compact('package', 'plans', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackage  $healthHubPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = 'warning';
        $msg = 'HealthHub Package Update successfully.';
        $updated = $this->healthHubPackageService->update($request->all(), $id);
        if($updated) {
            $type = 'message';
            $msg = 'HealthHub Package Update successfully.';
        }
        Session()->flash($type, $msg);
        return redirect('health-hub-feature-package');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackage  $healthHubPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->healthHubPackageService->delete($id);
        return $deleted;
    }

    public function updateDashboardId($id)
    {
        $dashboard = $this->healthHubDashBoardService->first();
        $this->healthHubPackageService->updateDashboardId($id, $dashboard->id);
        return ['value' => true];
    }

    public function deleteDashboardId($id)
    {
        $this->healthHubPackageService->deleteDashboardId($id);
        return ['value' => true];
    }
}
