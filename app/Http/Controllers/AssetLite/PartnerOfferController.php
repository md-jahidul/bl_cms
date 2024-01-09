<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Requests\PartnerOfferDetailRequest;
use App\Http\Requests\PartnerOfferDetailsRequest;
use App\Http\Requests\StorePartnerOfferRequest;
use App\Models\PartnerOfferDetail;
use App\Services\LmsOfferCategoryService;
use App\Services\LmsTierService;
use App\Services\PartnerOfferDetailService;
use App\Services\PartnerOfferService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Http\Controllers\AssetLite\ConfigController;
use Illuminate\Support\Facades\Validator;

class PartnerOfferController extends Controller {

    /**
     * @var $partnerOfferService
     */
    private $partnerOfferService;
    private $partnerOfferDetailService;
    /**
     * @var LmsOfferCategoryService
     */
    private $lmsOfferCategoryService;
    /**
     * @var LmsTierService
     */
    private $lmsTierService;

    public function __construct(
        PartnerOfferService $partnerOfferService,
        PartnerOfferDetailService $partnerOfferDetailService,
        LmsOfferCategoryService $lmsOfferCategoryService,
        LmsTierService $lmsTierService
    ) {
        $this->partnerOfferService = $partnerOfferService;
        $this->partnerOfferDetailService = $partnerOfferDetailService;
        $this->lmsOfferCategoryService = $lmsOfferCategoryService;
        $this->lmsTierService = $lmsTierService;
    }

    /**
     * @param $parentId
     * @param $partnerName
     * @return Factory|View
     */
    public function index($parentId, $partnerName) {
        $partnerOffers = $this->partnerOfferService->itemList($parentId);
        return view('admin.partner-offer.index', compact('partnerOffers', 'parentId', 'partnerName'));
    }

    public function partnerOffersHome() {
        $homePartnerOffers = $this->partnerOfferService->itemList(null, true);
        return view('admin.partner-offer.home', compact('homePartnerOffers'));
    }

    /**
     * @param $parentId
     * @param $partnerName
     * @return Factory|View
     */
    public function create($parentId, $partnerName) {
        $areas = $this->partnerOfferService->getAreaList();
        $tiers = $this->lmsTierService->findBy(['status' => 1]);
        $categories = $this->lmsOfferCategoryService->findBy(['status' => 1]);
        return view('admin.partner-offer.create', compact('parentId',
            'partnerName', 'areas', 'categories', 'tiers'
        ));
    }

    /**
     * @param StorePartnerOfferRequest $request
     * @param $partnerId
     * @param $partnerName
     * @return RedirectResponse|Redirector
     */
    public function store(StorePartnerOfferRequest $request, $partnerId, $partnerName)
    {
        $response = $this->partnerOfferService->storePartnerOffer($request->all(), $partnerId);
        Session::flash('message', $response->getContent());
        return redirect("partner-offer/$partnerId/$partnerName");
    }

    /**
     * @return Factory|View
     */
    public function campaignOfferList() {
        $campaignOffers = $this->partnerOfferService->campaignOffers();
        return view('admin.partner-offer.campaign', compact('campaignOffers'));
    }

    /**
     * @param Request $request
     */
    public function partnerOfferSortable(Request $request) {
        $this->partnerOfferService->partnerOfferSortable($request);
    }

    /**
     * @param Request $request
     */
    public function campaignOfferSortable(Request $request) {
        $this->partnerOfferService->campaignOfferSortable($request);
    }

    /**
     * @param $partnerId
     * @param $partnerName
     * @param $id
     * @return Factory|View
     */
    public function edit($partnerId, $partnerName, $id, $campaignPath = null) {

        $areas = $this->partnerOfferService->getAreaList();
        $partnerOffer = $this->partnerOfferService->findOne($id);
        $tiers = $this->lmsTierService->findBy(['status' => 1]);
        $categories = $this->lmsOfferCategoryService->findBy(['status' => 1]);
        return view('admin.partner-offer.edit', compact('partnerOffer',
            'partnerId', 'partnerName', 'areas', 'campaignPath', 'tiers', 'categories'
        ));
    }

    /**
     * @param StorePartnerOfferRequest $request
     * @param $partnerId
     * @param $partnerName
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(StorePartnerOfferRequest $request, $partnerId, $partnerName, $id)
    {
        $campaignList = $request->campaign_redirect;
        $response = $this->partnerOfferService->updatePartnerOffer($request->all(), $id);
        Session::flash('message', $response->getContent());
        return redirect(isset($campaignList) ? $campaignList : "partner-offer/$partnerId/$partnerName");
    }

    /**
     * @param $type
     * @param $id
     * @return Factory|View
     */
    public function offerDetailsEdit($partner, $id) {
        $partnerOfferDetail = $this->partnerOfferService->findOne($id, ['partner_offer_details']);
        return view('admin.partner-offer.offer_details', compact('partner', 'partnerOfferDetail'));
    }

    public function offerDetailsUpdate(PartnerOfferDetailRequest $request, $partnet)
    {
//        if ($validator->fails()) {
//            Session::flash('error', $validator->messages()->first());
//            return redirect()->back()->withInput();
//        }


        $response = $this->partnerOfferDetailService->updatePartnerOfferDetails($request->all(), $request->offer_details_id);
        Session::flash('message', $response->getContent());
        return redirect()->route('partner-offer', [$request->partner_id, $partnet]);
    }

    public function syncSearchData()
    {
        $response = $this->partnerOfferService->syncSearch();
        Session::flash('message', $response->getContent());
        return redirect('partners');
    }

    /**
     * @param $parentId
     * @param $parentName
     * @param $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Exception
     */
    public function destroy($partnerId, $partnerName, $id) {
        $response = $this->partnerOfferService->deletePartnerOffer($id);
        Session::flash('message', $response->getContent());
        return url("partner-offer/$partnerId/$partnerName");
    }

}
