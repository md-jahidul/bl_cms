<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StorePartnerOfferRequest;
use App\Services\PartnerOfferService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PartnerOfferController extends Controller
{

    /**
     * @var $partnerOfferService
     */
    private $partnerOfferService;

    public function __construct(PartnerOfferService $partnerOfferService)
    {
        $this->partnerOfferService = $partnerOfferService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $parentId
     * @param $partnerName
     * @return \Illuminate\Http\Response
     */
    public function index($parentId, $partnerName)
    {
        $partnerOffers = $this->partnerOfferService->itemList($parentId);

        return view('admin.partner-offer.index', compact('partnerOffers', 'parentId', 'partnerName'));
    }

    public function partnerOffersHome()
    {
        $homePartnerOffers = $this->partnerOfferService->itemList(null, true);
        return view('admin.partner-offer.home', compact('homePartnerOffers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parentId, $partnerName)
    {
        return view('admin.partner-offer.create', compact('parentId', 'partnerName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerOfferRequest $request, $partnerId, $partnerName)
    {
//        return $request->all();

        $response = $this->partnerOfferService->storePartnerOffer($request->all(), $partnerId);
        Session::flash('message', $response->getContent());
        return redirect("partner-offer/$partnerId/$partnerName");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function campaignOfferList()
    {
        $campaignOffers = $this->partnerOfferService->campaignOffers();
        return view('admin.partner-offer.campaign', compact('campaignOffers'));
    }

    /**
     * @param Request $request
     */
    public function partnerOfferSortable(Request $request)
    {
        $this->partnerOfferService->partnerOfferSortable($request);
    }

    /**
     * @param Request $request
     */
    public function campaignOfferSortable(Request $request)
    {
        $this->partnerOfferService->campaignOfferSortable($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($partnerId, $partnerName, $id)
    {
        $partnerOffer = $this->partnerOfferService->findOne($id);
        return view('admin.partner-offer.edit', compact('partnerOffer', 'partnerId', 'partnerName', 'path'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePartnerOfferRequest $request, $partnerId, $partnerName, $id)
    {
        $response = $this->partnerOfferService->updatePartnerOffer($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(isset($redirect) ? $redirect : "partner-offer/$partnerId/$partnerName");
    }

    /**
     * @param $parentId
     * @param $parentName
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($partnerId, $partnerName, $id)
    {
        $response = $this->partnerOfferService->deletePartnerOffer($id);
        Session::flash('message', $response->getContent());
        return url("partner-offer/$partnerId/$partnerName");
    }
}
