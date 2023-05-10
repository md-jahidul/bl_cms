<?php

namespace App\Http\Controllers\CMS;

use App\Services\NonBlOfferService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NonBlOfferController extends Controller
{
    private $nonBlOfferService;

    public function __construct(
        NonBlOfferService $nonBlOfferService
    ) {
        $this->nonBlOfferService = $nonBlOfferService;
    }

    public function index()
    {
        $offers = $this->nonBlOfferService->findAllOffers();

        return view('admin.nonbl.offers.index', compact('offers'));
    }

    public function offerStatusUpdate($id)
    {
        $response = $this->nonBlOfferService->changeStatus($id);
        Session::flash('success', $response->getContent());
        return redirect()->route('nonbl.offers');
    }
}
