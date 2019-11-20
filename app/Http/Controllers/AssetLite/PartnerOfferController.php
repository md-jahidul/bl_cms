<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\StorePartnerOfferRequest;
use App\Models\PartnerOfferDetail;
use App\Services\PartnerOfferDetailService;
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
    private $partnerOfferDetailService;

    public function __construct(
        PartnerOfferService $partnerOfferService,
        PartnerOfferDetailService $partnerOfferDetailService
    ) {
        $this->partnerOfferService = $partnerOfferService;
        $this->partnerOfferDetailService = $partnerOfferDetailService;
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

//        return $partnerName;

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
     * @param $type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function offerDetailsEdit($partner, $id)
    {
        $partnerOfferDetail = $this->partnerOfferService->findOne($id, ['partner_offer_details']);
        return view('admin.partner-offer.offer_details', compact('partner', 'partnerOfferDetail', 'products'));
    }

    public function offerDetailsUpdate(Request $request, $partnet)
    {
        $response = $this->partnerOfferDetailService
            ->updatePartnerOfferDetails($request->all(), $request->offer_details_id);
        Session::flash('message', $response->getContent());
        return redirect()->route('partner-offer', [$request->partner_id, $partnet]);
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
