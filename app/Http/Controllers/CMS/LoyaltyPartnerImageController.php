<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerImageRequest;
use App\Services\LoyaltyPartnerImageService;
use App\Services\PartnerService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoyaltyPartnerImageController extends Controller
{
    /**
     * @var PartnerService
     */
    private $partnerService;
    /**
     * @var LoyaltyPartnerImageService
     */
    private $loyaltyPartnerImageService;
    /**
     * @var mixed
     */
    private $storageHost;

    /**
     * @param PartnerService $partnerService
     * @param LoyaltyPartnerImageService $loyaltyPartnerImageService
     */
    public function __construct(PartnerService $partnerService, LoyaltyPartnerImageService $loyaltyPartnerImageService)
    {
        $this->partnerService = $partnerService;
        $this->storageHost = env('BL_API_HOST');
        $this->loyaltyPartnerImageService = $loyaltyPartnerImageService;
    }

    /**
     * Loyality Partner Index
     */
    public function index()
    {
        $loyaltyPartnerCategories = $this->partnerService->partnerCategories()->toArray();
        $loyaltyPartnerImages = $this->loyaltyPartnerImageService->findAll();
        $host = $this->storageHost;

        return view('admin.loyalty-partner.index', compact('loyaltyPartnerImages', 'loyaltyPartnerCategories', 'host'));
    }

    /**
     * Loyality Partner Image Upload
     */
    public function create()
    {
        $loyaltyPartnerCategories = $this->partnerService->partnerCategories()->toArray();
        return view('admin.loyalty-partner.create', compact('loyaltyPartnerCategories'));
    }

    /**
     * Loyality Partner Image Upload
     * @param StorePartnerImageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePartnerImageRequest $request)
    {
        $response = $this->loyaltyPartnerImageService->storePartnerImage($request->all());
        Session::flash('message', 'Partner image upload successful');

        return redirect('/loyalty-partner-image');
    }

    /**
     * Loyality Partner Image Upload
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $loyaltyPartnerImage = $this->loyaltyPartnerImageService->findOne($id);
        $loyaltyPartnerCategories = $this->partnerService->partnerCategories()->toArray();
        $host = $this->storageHost;

        return view('admin.loyalty-partner.edit', compact('loyaltyPartnerCategories', 'loyaltyPartnerImage'));
    }


    /**
     * @param StorePartnerImageRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StorePartnerImageRequest $request, $id)
    {
        $response = $this->loyaltyPartnerImageService->updatePartnerImage($request->except('_token', '_method'), $id);
        Session::flash('message', 'Partner image updated');

        return redirect('/loyalty-partner-image');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->loyaltyPartnerImageService->deletePartnerOffer($id);
        Session::flash('message', 'Partner image deleted');

        return redirect('/loyalty-partner-image');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        return $this->loyaltyPartnerImageService->getAnalytics($request::all());
    }

    public function report(Request $request)
    {
        return $this->loyaltyPartnerImageService->getReport($request::all());
    }


}
