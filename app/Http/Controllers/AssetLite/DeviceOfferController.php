<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\DeviceOfferService;
use App\Models\DeviceOffer;
use Illuminate\Http\Request;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class DeviceOfferController extends Controller {

    private $deviceOfferService;

    /**
     * DeviceOfferController constructor.
     * @param DeviceOfferService $deviceOfferService
     */
    public function __construct(DeviceOfferService $deviceOfferService) {
        $this->deviceOfferService = $deviceOfferService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 04/02/2020
     */
    public function index() {
        $brands = $this->deviceOfferService->getBrands();
        return view('admin.device-offer.index', compact('brands'));
    }

    public function deviceOfferList(Request $request) {

        $response = $this->deviceOfferService->getDeviceOffers($request);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadOfferByExcel(Request $request) {

        $response = $this->deviceOfferService->saveExcel($request);
        return $response;
    }

    public function offerStatusChange(Request $request) {
        $offerId = $request->offerId;
        $response = $this->deviceOfferService->statusChange($offerId);
        return $response;
    }

    public function deleteDeviceOffer($offerId = 0) {

        $response = $this->deviceOfferService->deleteOffer($offerId);
        return $response;
    }

}
