<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MinuteOfferService;
use Illuminate\Support\Facades\Session;

class MinuteOfferController extends Controller
{
    /**
     * @var MinuteOfferService
     */
    private $minuteOfferService;
    private $sliderTypeService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param MinuteOfferService $minuteOfferService
     */
    public function __construct(MinuteOfferService $minuteOfferService)
    {
        $this->minuteOfferService = $minuteOfferService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offer-minute.index')->with('minute_offers',$this->minuteOfferService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-minute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->minuteOfferService->storeMinuteOffer($request->all());
        Session::flash('message', $response->content());
        return redirect(route('minuteOffer.index'));
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
        return view('admin.offer-minute.edit')->with('minute_offer',$this->minuteOfferService->findOne($id));
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
        session()->flash('success',$this->minuteOfferService->updateMinuteOffer($request,$id)->getContent());
        return redirect(route('minuteOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        session()->flash('success',$this->minuteOfferService->deleteMinuteOffer($id)->getContent());
        return redirect(route('minuteOffer.index'));
    }
}
