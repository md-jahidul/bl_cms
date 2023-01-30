<?php

namespace App\Http\Controllers\AssetLite;

use App\Repositories\AppServiceTabRepository;
use App\Services\Assetlite\AppServiceCategoryService;
use App\Services\Assetlite\AppServiceTabService;
use App\Services\LmsTierService;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LoyaltyTierController extends Controller
{
    /**
     * @var LmsTierService
     */
    private $lmsTierService;

    /**
     * LoyaltyTierController constructor.
     * @param LmsTierService $lmsTierService
     */
    public function __construct(
        LmsTierService $lmsTierService
    ) {
        $this->lmsTierService = $lmsTierService;
    }

    /**
     * Display a listing of the App Service Category.
     *
     * @return Factory|View
     */
    public function index()
    {
        $lmsTires = $this->lmsTierService->findAll('', '', [
                'column' => 'display_order',
                'direction' => 'ASC'
            ]);
        return view('admin.loyalty.lms-tier.index', compact('lmsTires'));
    }

    /**
     * Show the form for creating a new App Service Category.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.loyalty.lms-tier.create');
    }

    /**
     * Store a newly created App Service Category in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->lmsTierService->storeLmsTier($request->all());
        Session::flash('message', 'App Service Category Add successfully!');
        return redirect('loyalty/tier');
    }


    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $lmsTier = $this->lmsTierService->findOne($id);
        return view('admin.loyalty.lms-tier.edit', compact('lmsTier'));
    }

    /**
     * Update a App Service category items
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $this->lmsTierService->updateLmsTier($request->all(), $id);
        Session::flash('message', 'App Service Category Update successfully!');
        return redirect('loyalty/tier');
    }

    /**
     * @param $data
     * @return Response
     */
    public function tierSort(Request $request)
    {
       return $this->lmsTierService->tableSortable($request->position);
    }

    /**
     * Delete a App Service category items
     *
     * @param $id
     * @return UrlGenerator|string
     * @throws Exception
     */
    public function destroy($id)
    {
        $this->lmsTierService->deleteLmsTier($id);
        return url('loyalty/tier');
    }
}
