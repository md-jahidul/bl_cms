<?php

namespace App\Http\Controllers\CMS\HealthHubNewJourney;

use App\HealthHubPartner;
use App\Services\HealthHubNewJourney\HealthHubPartnerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthHubPartnerController extends Controller
{
    private $healthHubPartnerService;
    public function __construct(HealthHubPartnerService $healthHubPartnerService)
    {
        $this->healthHubPartnerService = $healthHubPartnerService;
    }

    public function index()
    {
        $partners = $this->healthHubPartnerService->findAll();

        return view('admin.health-hub-new-journey.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.health-hub-new-journey.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->healthHubPartnerService->save($request->all()))Session()->flash('message', 'Partner Created successfully.');
        else session()->flash('warning', 'Partner Created Failed');

        return redirect('health-hub-feature-partner');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HealthHubPartner  $healthHubPartner
     * @return \Illuminate\Http\Response
     */
    public function show(HealthHubPartner $healthHubPartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HealthHubPartner  $healthHubPartner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = $this->healthHubPartnerService->findOne($id);

        return view('admin.health-hub-new-journey.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HealthHubPartner  $healthHubPartner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if($this->healthHubPartnerService->update($request->all(), $id))Session()->flash('message', 'Partner Update successfully.');
        else session()->flash('warning', 'Partner Updated Failed');

        return redirect('health-hub-feature-partner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HealthHubPartner  $healthHubPartner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->healthHubPartnerService->delete($id);
    }
}
