<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MixedBundleOfferRequest;
use App\Services\MixedBundleOfferService;
use Illuminate\Support\Facades\Session;

class MixedBundleOfferController extends Controller
{
    /**
     * @var MixedBundleOfferService
     */
    private $mixedBundleOfferService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param MixedBundleOfferService $mixedBundleOfferService
     */
    public function __construct(MixedBundleOfferService $mixedBundleOfferService)
    {
        $this->mixedBundleOfferService = $mixedBundleOfferService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offer-mixedbundle.index')->with('mixedBundle_offers', $this->mixedBundleOfferService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-mixedbundle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MixedBundleOfferRequest $request)
    {
        // return $request;
        $response = $this->mixedBundleOfferService->storeMixedBundleOffer($request->all());
        Session::flash('message', $response->content());
        return redirect(route('mixedBundleOffer.index'));
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
        return view('admin.offer-mixedbundle.edit')->with('mixedBundle_offer', $this->mixedBundleOfferService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MixedBundleOfferRequest $request, $id)
    {
        session()->flash('success', $this->mixedBundleOfferService->updateMixedBundleOffer($request, $id)->getContent());
        return redirect(route('mixedBundleOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->mixedBundleOfferService->deleteMixedBundleOffer($id)->getContent());
        return url('mixedBundleOffer');
    }
}
