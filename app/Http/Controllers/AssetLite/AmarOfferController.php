<?php

namespace App\Http\Controllers\AssetLite;

use App\Http\Controllers\Controller;

use App\Models\AmarOfferDetails;
use Illuminate\Http\Request;

class AmarOfferController extends Controller
{

    private $amarOfferDetails;



    /**
     * AmarOfferController constructor.
     * @param AmarOfferDetails $amarOfferDetails
     */
    public function __construct(AmarOfferDetails $amarOfferDetails) {
        $this->amarOfferDetails = $amarOfferDetails;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param $type
     * @return Factory|View
     * @Bulbul Mahmud Nito || 02/02/2020
     */
    public function index()
    {
        $offerDetails = $this->amarOfferDetails->orderBy('type')->get();

        return view('admin.amar-offer-details.index', compact('offerDetails'));
    }


    /**
     * Edit the specified resource.
     *
     * @param int $id
     * @return Response
     * @Bulbul Mahmud Nito || 02/02/2020
     */
    public function edit($id)
    {
        $detailsData = $this->amarOfferDetails->findOrFail($id);
        return view('admin.amar-offer-details.edit', compact('detailsData'));
    }
    
    /**
     * Update/save the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Redirect
     * @Bulbul Mahmud Nito || 02/02/2020
     */
    public function update(Request $request, $id){
        $details = $this->amarOfferDetails->findOrFail($id);
        $details->details_en = $request->offer_details_en;
        $details->details_bn = $request->offer_details_bn;
        $details->save();
        return redirect("amaroffer/details");
    }

    
}
