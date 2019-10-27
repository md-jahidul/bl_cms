<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\CampaignRepository;
use App\Services\CampaignService;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CampaignController extends Controller
{
    /**
     * @var $campaignService
     */
    private $campaignService;

    /**
     * @var $tagService
     */
    private $tagService;


    public function __construct(CampaignService $campaignService, TagService $tagService)
    {
        $this->campaignService = $campaignService;
        $this->tagService = $tagService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->campaignService->findAll();
        return view('admin.campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->campaignService->storeCampaign($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/campaigns');
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
    public function edit($id)
    {
        $campaign = $this->campaignService->findOne($id);
        return view('admin.campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = $this->campaignService->updateCampaign($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('campaigns');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->campaignService->deleteCampaign($id);
        Session::flash('message', $response->getContent());
        return redirect('/campaigns');
    }
}
