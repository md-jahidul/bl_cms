<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Requests\NearbyOfferRequest;
use App\Http\Controllers\Controller;
use App\Services\NearbyOfferService;
use Illuminate\Support\Facades\Session;
use App\Models\NearbyOffer;

class NearbyOfferController extends Controller
{
    /**
     * @var NearbyOfferService
     */
    private $nearbyOfferService;
    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param NearbyOfferService $nearbyOfferService
     */
    public function __construct(NearbyOfferService $nearbyOfferService)
    {
        $this->nearbyOfferService = $nearbyOfferService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBy = ['column' => "id", 'direction' => 'desc'];
        $nearByOffers = $this->nearbyOfferService->findAll('', '', $orderBy);
        return view('admin.offer-nearby.index')->with('nearByOffers', $nearByOffers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-nearby.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NearbyOfferRequest $request)
    {
        session()->flash('message', $this->nearbyOfferService->storeNearbyOffer($request->all())->getContent());
        return redirect(route('nearByOffer.index'));
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
        return view('admin.offer-nearby.edit')
                ->with('nearByOffer', $this->nearbyOfferService->findOne($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NearbyOfferRequest $request, NearbyOffer $nearByOffer)
    {
        session()->flash('success', $this->nearbyOfferService->updateNearbyOffer($request->all(), $nearByOffer)->getContent());
        return redirect(route('nearByOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('error', $this->nearbyOfferService->deleteNearbyOffer($id)->getContent());
        return url('nearByOffer');
    }
}
