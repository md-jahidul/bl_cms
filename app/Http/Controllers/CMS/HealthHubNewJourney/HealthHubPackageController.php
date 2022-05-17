<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\Http\Controllers\Controller;
use App\Models\HealthHubNewJourney\HealthHubPackage;
use App\Services\HealthHubNewJourney\HealthHubPackageService;
use App\Services\HealthHubNewJourney\HealthHubPartnerService;
use App\Services\HealthHubNewJourney\HealthHubPlanService;
use Illuminate\Http\Request;

class HealthHubPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $healthHubPackageService, $healthHubPartnerService, $healthHubPlanService;

    public function __construct(
        HealthHubPackageService $healthHubPackageService,
        HealthHubPartnerService $healthHubPartnerService,
        HealthHubPlanService    $healthHubPlanService
    ){
        $this->healthHubPackageService = $healthHubPackageService;
        $this->healthHubPartnerService = $healthHubPartnerService;
        $this->healthHubPlanService    = $healthHubPlanService;
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
        $partners = $this->healthHubPartnerService->findAll();
        $plans    = $this->healthHubPlanService->findAll();

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
        if($this->healthHubPackageService->save($request->all()))Session()->flash('message', 'HealthHub Package Created successfully.');
        else session()->flash('warning', 'HealthHub Package Created Failed');

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
//        dd($package);
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
        if($this->healthHubPackageService->update($request->all(), $id))Session()->flash('message', 'HealthHub Package Update successfully.');
        else session()->flash('warning', 'HealthHub Package Updated Failed');

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
        //
    }
}
