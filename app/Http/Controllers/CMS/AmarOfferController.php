<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Requests\AmarOfferRequest;
use App\Http\Controllers\Controller;
use App\Services\AmarOfferService;
use App\Models\AmarOffer;

class AmarOfferController extends Controller
{

    /**
     * @var AmarOfferService
     */
    private $amarOfferService;

    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param AmarOfferService $amarOfferService
     */
    public function __construct(AmarOfferService $amarOfferService)
    {
        $this->amarOfferService = $amarOfferService;
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
        $amarOffers = $this->amarOfferService->findAll('', '', $orderBy);

        return view('admin.offer-Amar.index')->with('amarOffers', $amarOffers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer-Amar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmarOfferRequest $request)
    {
        $response = $this->amarOfferService->storeAmarOffer($request->all());
        Session()->flash('message', $response->content());
        return redirect(route('amarOffer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AmarOffer $amarOffer)
    {
        return view('admin.offer-Amar.show')->with('amarOffer', $amarOffer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AmarOffer $amarOffer)
    {
        return view('admin.offer-Amar.edit')->with('amarOffer', $amarOffer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AmarOfferRequest $request, $id)
    {
        $response = $this->amarOfferService->updateAmarOffer($request->all(), $id);
        Session()->flash('success', $response->content());
        return redirect(route('amarOffer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->amarOfferService->deleteAmarOffer($id);
        Session()->flash('error', $response->content());
        return url('amarOffer');
    }
}
