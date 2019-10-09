<?php

namespace App\Http\Controllers\CMS;

use App\Services\CampaignService;
use App\Services\PrizeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        $this->middleware('auth');
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
        $response = $this->prizeService->storePrize($request->all());
        Session::flash('message', $response->content());
        return redirect('prizes');
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
        $prize = $this->prizeService->findOne($id);
        $campaigns = $this->campaignService->findAll();
        return view('admin.prize.edit', compact('prize', 'campaigns'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $response = $this->prizeService->updatePrize($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect('/prizes');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->prizeService->deletePrize($id);
        Session::flash('message', $response->getContent());
        return redirect('/prizes');
    }
}
