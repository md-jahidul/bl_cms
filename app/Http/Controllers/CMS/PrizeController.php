<?php

namespace App\Http\Controllers\CMS;

use App\Services\CampaignService;
use App\Services\PrizeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrizeController extends Controller
{
    /**
     * @var $prizeService
     */
    private $prizeService;

    /**
     * @var $prizeService
     */
    private $campaignService;

    /**
     * PrizeController constructor.
     * @param PrizeService $prizeService
     * @param CampaignService $campaignService
     */
    public function __construct(PrizeService $prizeService, CampaignService $campaignService)
    {
        $this->prizeService = $prizeService;
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prizes = $this->prizeService->findAll('', 'campaign');
        return view('admin.prize.index', compact('prizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaigns = $this->campaignService->findAll();

        return view('admin.prize.create', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
