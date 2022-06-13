<?php

namespace App\Http\Controllers\CMS\NewCampaignModality;

use App\Http\Controllers\Controller;
use App\Models\NewCampaignModality\MyBlCampaignSection;
use App\Services\NewCampaignModality\MyBlCampaignSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyBlCampaignSectionController extends Controller
{

    private $myblCampaignSectionService;

    public function __construct(MyBlCampaignSectionService $myblCampaignSectionService)
    {
        $this->myblCampaignSectionService = $myblCampaignSectionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->myblCampaignSectionService->findAll();

        return view('admin.mybl-campaign.new-campaign-modality.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mybl-campaign.new-campaign-modality.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->myblCampaignSectionService->save($request->all())) {
            Session::flash('message', 'Section store successful');
        }
        else{
            Session::flash('danger', 'Section Stored Failed');
        }

        return redirect('mybl-campaign-section');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewCampaignModality\MyBlCampaignSection  $myBlCampaignSection
     * @return \Illuminate\Http\Response
     */
    public function show(MyBlCampaignSection $myBlCampaignSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewCampaignModality\MyBlCampaignSection  $myBlCampaignSection
     * @return \Illuminate\Http\Response
     */
    public function edit($myBlCampaignSectionId)
    {
        $section = $this->myblCampaignSectionService->findOne($myBlCampaignSectionId);

        return view('admin.mybl-campaign.new-campaign-modality.section.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewCampaignModality\MyBlCampaignSection  $myBlCampaignSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $myBlCampaignSectionId)
    {
        if ($this->myblCampaignSectionService->update($myBlCampaignSectionId, $request->all())) {
            Session::flash('message', 'Section Update successful');
        }
        else{
            Session::flash('danger', 'Section Update Failed');
        }

        return redirect('mybl-campaign-section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewCampaignModality\MyBlCampaignSection  $myBlCampaignSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($myBlCampaignSectionId)
    {
        return $this->myblCampaignSectionService->delete($myBlCampaignSectionId);
    }
}
