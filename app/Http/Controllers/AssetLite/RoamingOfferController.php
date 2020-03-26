<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;
use App\Services\RoamingOfferService;
use Illuminate\Http\Request;
use Session;

class RoamingOfferController extends Controller {

    private $offerService;

    /**
     * RoamingOfferController constructor.
     * @param RoamingOfferService $offerService
     */
    public function __construct(RoamingOfferService $offerService) {
        $this->offerService = $offerService;
    }

    /**
     * Display Categories, about page, bill payment page
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 24/03/2020
     */
    public function index() {
        $categories = $this->offerService->getCategories();
        $offers = $this->offerService->getOffers();

        return view('admin.roaming.offers', compact('categories', 'offers'));
    }

    /**
     * Get category by ID
     * 
     * @param cat ID $catId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/03/2020
     */
    public function getSingleCategory($catId) {

        $response = $this->offerService->getCategoryById($catId);
        return $response;
    }

    /**
     * Update category
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/03/2020
     */
    public function saveCategory(Request $request) {

        $response = $this->offerService->updateCategory($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Category is saved!');
        } else {
            Session::flash('error', 'Category saving process failed!');
        }

        return redirect('/roaming-offers');
    }

    /**
     * Category Sorting Change.
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/03/2020
     */
    public function categorySortChange(Request $request) {
        $sortChange = $this->offerService->changeCategorySort($request);
        return $sortChange;
    }

    /**
     * Add other offer
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 24/03/2020
     */
    public function createOffer() {

        $categories = $this->offerService->getCategories();

        return view('admin.roaming.create_other_offer', compact('categories'));
    }

    /**
     * edit other offer
     * 
     * @param No
     * @return Factory|View
     * @Bulbul Mahmud Nito || 25/03/2020
     */
    public function editOffer($offerId) {
        $categories = $this->offerService->getCategories();
        $offer = $this->offerService->getOfferById($offerId);
        return view('admin.roaming.edit_other_offer', compact('categories', 'offer'));
    }

    /**
     * Save other offer
     * 
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 24/03/2020
     */
    public function saveOffer(Request $request) {
//        print_r($request->all());die();

        if ($request->offer_id == "") {
            $response = $this->offerService->saveOffer($request);
        } else {
            $response = $this->offerService->updateOffer($request);
        }

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is saved!');
        } else {
            Session::flash('error', 'Offer saving process failed!');
        }

        return redirect('roaming-offers');
    }

    /**
     * Component Sorting Change.
     * 
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 24/03/2020
     */
    public function componentSortChange(Request $request) {
        $sortChange = $this->generalService->changeComponentSort($request);
        return $sortChange;
    }

}
