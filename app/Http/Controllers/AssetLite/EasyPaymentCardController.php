<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\EasyPaymentCardService;
use Illuminate\Http\Request;

class EasyPaymentCardController extends Controller {

    private $paymentCardService;

    /**
     * EasyPaymentCardController constructor.
     * @param EasyPaymentCardService $paymentCardService
     */
    public function __construct(EasyPaymentCardService $paymentCardService) {
        $this->paymentCardService = $paymentCardService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 02/02/2020
     */
    public function index() {
        $divisions = $this->paymentCardService->getDivisions();
        return view('admin.easy-payment-card.index', compact('divisions'));
    }

    public function getEasyPaymentCardList(Request $request) {
        $response = $this->paymentCardService->getPaymentCards($request);
        return $response;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadCardByExcel(Request $request) {
        $response = $this->paymentCardService->saveExcel($request);
        return $response;
    }

    public function cardStatusChange(Request $request) {

        $cardId = $request->cardId;
        $response = $this->paymentCardService->statusChange($cardId);
        return $response;
    }

    public function deletePaymentCard($cardId = 0) {
        $response = $this->paymentCardService->deleteCard($cardId);
        return $response;
    }
    

}
