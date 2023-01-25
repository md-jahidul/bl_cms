<?php

namespace App\Http\Controllers\AssetLite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RoamingOfferService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        $validator =  Validator::make($request->all(), [
            'name_en' => 'required',
            'name_bn' => 'required',
            'card_text_en' => 'required',
            'card_text_bn' => 'required',
//            'banner_name' => 'required|regex:/^\S*$/u',
            'url_slug' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,url_slug,' . $request->offer_id,
            'url_slug_bn' => 'required|regex:/^\S*$/u|unique:roaming_other_offer,url_slug_bn,' . $request->offer_id,
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back();
        }

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
     * Delete other offer
     *
     * @param $offerId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 25/03/2020
     */
    public function deleteOffer($offerId) {
        $response = $this->offerService->deleteOffer($offerId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is deleted!');
        } else {
            Session::flash('error', 'Offer deleting process failed!');
        }

        return redirect('roaming-offers');
    }


    /**
     * edit other offer components
     *
     * @param $offerId
     * @return Factory|View
     * @Bulbul Mahmud Nito || 25/03/2020
     */
    public function editComponent($offerId) {
        $components = $this->offerService->getOfferComponents($offerId);
        return view('admin.roaming.offer_components', compact('components', 'offerId'));
    }

    /**
     * Update other offer components
     *
     * @param Request $request
     * @return Factory|View
     * @Bulbul Mahmud Nito || 26/03/2020
     */
    public function updateComponent(Request $request) {
//        dd($request->all());

        $response = $this->offerService->updateComponents($request);

        if ($response['success'] == 1) {
            Session::flash('sussess', 'Offer is saved!');
        } else {
            Session::flash('error', 'Offer saving process failed!');
        }

        return redirect('roaming/edit-other-offer-component/'.$request->parent_id);
    }

    /**
     * Component Sorting Change.
     *
     * @param Request $request
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 26/03/2020
     */
    public function componentSortChange(Request $request) {
        $sortChange = $this->offerService->changeComponentSort($request);
        return $sortChange;
    }


    /**
     * Component delete.
     *
     * @param $infoId, $comId
     * @return JsonResponse
     * @Dev Bulbul Mahmud Nito || 27/03/2020
     */
    public function componentDelete($offerId, $comId) {

        $response = $this->offerService->componentDelete($comId);
        if ($response['success'] == 1) {
            Session::flash('sussess', 'Component is deleted!');
        } else {
            Session::flash('error', 'Component delete process failed!');
        }

        return redirect('roaming/edit-other-offer-component/' . $offerId);
    }

}
