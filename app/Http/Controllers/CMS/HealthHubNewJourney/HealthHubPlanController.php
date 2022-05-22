<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthHubPlanRequest;
use App\Models\HealthHubNewJourney\HealthHubPackageCategory;
use App\Services\HealthHubNewJourney\HealthHubPlanService;
use Illuminate\Http\Request;

class HealthHubPlanController extends Controller
{
    private $healthHubPlanService;
    public function __construct(HealthHubPlanService $healthHubPlanService)
    {
        $this->healthHubPlanService = $healthHubPlanService;
    }

    public function index()
    {
        $plans = $this->healthHubPlanService->findAll();

        return view('admin.health-hub-new-journey.plan.index', compact('plans'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.health-hub-new-journey.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HealthHubPlanRequest $request)
    {
        if($this->healthHubPlanService->save($request->all()))Session()->flash('message', 'HealthHub Plan Created successfully.');
        else session()->flash('warning', 'HealthHub Plan Created Failed');

        return redirect('health-hub-feature-dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackageCategory  $healthHubPackageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(HealthHubPackageCategory $healthHubPackageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackageCategory  $healthHubPackageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = $this->healthHubPlanService->findOne($id);

        return view('admin.health-hub-new-journey.plan.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackageCategory  $healthHubPackageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->healthHubPlanService->update($request->all(), $id))Session()->flash('message', 'Plan Update successfully.');
        else session()->flash('warning', 'Plan Updated Failed');

        return redirect('health-hub-feature-dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthHubNewJourney\HealthHubPackageCategory  $healthHubPackageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->healthHubPlanService->delete($id);
    }
}
