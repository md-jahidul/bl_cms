<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;

use App\Models\AmarOfferDetails;
use App\Services\AlBannerService;
use App\Services\AmarOfferDetailsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AmarOfferController extends Controller
{

    private $amarOfferDetailsService;
    /**
     * @var AlBannerService
     */
    private $alBannerService;

    /**
     * AmarOfferController constructor.
     * @param AmarOfferDetailsService $amarOfferDetailsService
     */
    public function __construct(
        AmarOfferDetailsService $amarOfferDetailsService,
        AlBannerService $alBannerService
    ) {
        $this->amarOfferDetailsService = $amarOfferDetailsService;
        $this->alBannerService = $alBannerService;
    }

    /**
     * @return Factory|View|void
     */
    public function amarOfferDetails()
    {
        $offerDetails = $this->amarOfferDetailsService->amarOfferDetailsList();

        $banner = $this->alBannerService->findBanner('amar_offer', 0);
        return view('admin.amar-offer-details.index', compact('offerDetails', 'banner'));
    }


    public function bannerImageUpload(Request $request)
    {
        $response = $this->amarOfferDetailsService->bannerImageUpload($request->all());
        Session::flash('message', $response->getContent());
        return redirect(route('amaroffer.list'));
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($type)
    {
        $detailsData = $this->amarOfferDetailsService->findByType($type);
        return view('admin.amar-offer-details.edit', compact('detailsData'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $type)
    {
        $details = $this->amarOfferDetailsService->findByType($type);
        $details->details_en = $request->details_en;
        $details->details_bn = $request->details_bn;
        $details->save();
        return redirect("amaroffer/details");
    }


}
