<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SmsOfferService;
use Illuminate\Support\Facades\Session;

class SmsOfferController extends Controller
{
    /**
     * @var SmsOfferService
     */
    private $smsOfferService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param SmsOfferService $smsOfferService
     */
    public function __construct(SmsOfferService $smsOfferService)
    {
        $this->smsOfferService = $smsOfferService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offer-sms.index')->with('sms_offers',$this->smsOfferService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->smsOfferService->storeSmsOffer($request->all());
        Session::flash('message', $response->content());
        return redirect(route('smsOffer.index'));
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
        return view('admin.offer-sms.edit')->with('sms_offer',$this->smsOfferService->findOne($id));
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
        //dd($request,$id);
        session()->flash('success',$this->smsOfferService->updateSmsOffer($request,$id)->getContent());
        return redirect(route('smsOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('success',$this->smsOfferService->deleteSmsOffer($id)->getContent());
        return redirect(route('smsOffer.index'));
    }
}
