<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Requests\InternetOfferRequest;
use App\Http\Controllers\Controller;
use App\Services\InternetOfferService;
use Illuminate\Support\Facades\Session;

class InternetOfferController extends Controller
{
    /**
     * @var internetOfferService
     */
    private $internetOfferService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param InternetOfferService $internetOfferService
     */
    public function __construct(InternetOfferService $internetOfferService)
    {
        $this->internetOfferService = $internetOfferService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offer-internet.index')->with('internet_offers', $this->internetOfferService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-internet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternetOfferRequest $request)
    {
        $response = $this->internetOfferService->storeInternetOffer($request->all());
        Session::flash('message', $response->content());
        return redirect(route('internetOffer.index'));
        //dd($request);
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
        return view('admin.offer-internet.edit')->with('internet_offer', $this->internetOfferService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternetOfferRequest $request, $id)
    {
        session()->flash('success', $this->internetOfferService->updateInternetOffer($request, $id)->getContent());
        return redirect(route('internetOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->internetOfferService->destroyInternetOffer($id)->getContent());
        return url('internetOffer');
    }
}
