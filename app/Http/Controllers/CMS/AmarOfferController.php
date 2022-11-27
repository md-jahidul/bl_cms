<?php

namespace App\Http\Controllers\CMS;

use App\Services\BaseMsisdnService;
use Illuminate\Http\Request;
use App\Http\Requests\AmarOfferRequest;
use App\Http\Controllers\Controller;
use App\Services\AmarOfferService;
use App\Models\AmarOffer;
use Illuminate\Support\Facades\Redis;

class AmarOfferController extends Controller
{

    /**
     * @var AmarOfferService
     */
    private $amarOfferService, $baseMsisdnService;

    /**
     * @var bool
     */
    private $isAuthenticated = true;

    /**
     * BannerController constructor.
     * @param AmarOfferService $amarOfferService
     */
    public function __construct
    (
        AmarOfferService $amarOfferService,
        BaseMsisdnService $baseMsisdnService
    ){

        $this->amarOfferService = $amarOfferService;
        $this->baseMsisdnService = $baseMsisdnService;
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amarOffers = $this->amarOfferService->findAll();
        $amarOfferIncident = Redis::get('amar-offer-incident') == null ? 0 : Redis::get('amar-offer-incident');

        return view('admin.offer-Amar.index', compact('amarOffers', 'amarOfferIncident'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();

        return view('admin.offer-Amar.create', compact('baseMsisdnGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function edit($amarOfferId)
    {
        $baseMsisdnGroups = $this->baseMsisdnService->findAll();
        $amarOffer = $this->amarOfferService->findOne($amarOfferId);

        return view('admin.offer-Amar.edit', compact('amarOffer', 'baseMsisdnGroups'));
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

    public function statusUpdate()
    {
        if (Redis::get("amar-offer-incident") == null) {
            Redis::set("amar-offer-incident", 1);
        } else {
            $flag = Redis::get("amar-offer-incident");

            if ($flag == 1) {
                Redis::set("amar-offer-incident", 0);
            } else {
                Redis::set("amar-offer-incident", 1);
            }
        }

        Session()->flash("Amar Offer Incident Status Update Successfully");
        return redirect(route('amarOffer.index'));
    }
}
